<?php

namespace Pletfix\UserManager\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Core\Services\Contracts\Response;

/**
 * This controller handles the registration of new users as well as their validation and creation.
 */
class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

//    /**
//     * Create a new controller instance.
//     */
//    public function __construct()
//    {
//    }

    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function showForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @return Response
     */
    public function register()
    {
        $input = request()->input();

        // Validate the input.

//        $validator = Validator::make($input, array_except(User::getRules(), 'role'));
//        if ($validator->fails()) {
//            $this->throwValidationException($request, $validator);
//        }

        $email = $input['email'];
        $user = User::whereIs('email', $email)->first();
        if ($user !== null) {
            return redirect('auth/register', [], [
                'errors.email' => 'Diese E-Mail-Adresse ist bereits registriert.',
                'input' => $input,
            ]);
        }

        if ($input['password'] !== $input['password_confirmation']) { // todo entfällt, wenn Validator realisiert ist
            return redirect('auth/register', [], [
                'errors.password_confirmation' => 'Das Kennwort stimmt nicht überein.',
                'input' => $input,
            ]);
        }

        // Create the user account.

        $user = $this->create($input);

        // Login the user (without role yet)

        auth()->login($input);

        // Send a mail to verify the email address.

        $this->sendMail($user);

        return redirect($this->redirectTo, [], ['message' => 'Eine E-Mail wurde zwecks Verifizierung an dich versendet!']);
    }

    /**
     * Create a new user entity.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->confirmation_token = random_string('60');
        $user->save();

        return $user;
    }

    /**
     * Send an email to the user for verification the email address.
     *
     * @param User $user
     */
    protected function sendMail(User $user)
    {
        mailer()
            ->subject('E-Mail-Adresse verifizieren')
            ->to($user->email, $user->name)
            ->view('auth.emails.register', compact('user'))
            ->send();
    }

    /**
     * Confirm the email address.
     *
     * @param string $confirmationToken
     * @return Response
     */
    public function confirm($confirmationToken)
    {
        // Validate the input.

        $email = request()->input('email');
        if ($email === null) {
            abort(HTTP_STATUS_BAD_REQUEST);
        }

        $user = User::whereIs('email', $email)->whereIs('confirmation_token', $confirmationToken)->first();
        if ($user === null) {
            abort(HTTP_STATUS_FORBIDDEN, 'Token is invalid.');
        }

        // Update the user role from "guest" to "user".

        $user->role = 'user';
        $user->confirmation_token = null;
        $user->save();
        $auth = auth();
        if ($auth->isLoggedIn()) {
            $auth->changeRole($user->role);
        }

        return view('auth.confirm', compact('user'));
    }

    /**
     * Send the email to verify the email address ones more.
     *
     * @return Response
     */
    public function resend()
    {
        $user = User::find(auth()->id());
        if ($user === null) {
            abort(HTTP_STATUS_FORBIDDEN);
        }

        if (empty($user->confirmation_token)) {
            return redirect($this->redirectTo, [], ['message' => 'Die E-Mail-Adresse wurde inzwischen verifiziert.']);
        }

        $this->sendMail($user);

        return redirect($this->redirectTo, [], ['message' => 'Eine E-Mail wurde zwecks Verifizierung an dich versendet!']); // redirect()->back()->with('message', 'Eine E-Mail zur Verifizierung wurde versendet.');
    }
}
