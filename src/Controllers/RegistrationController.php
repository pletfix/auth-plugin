<?php

namespace Pletfix\Auth\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use Core\Services\Contracts\Response;

/**
 * This controller handles the registration of new users as well as their validation and creation.
 */
class RegistrationController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

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
        $email = $input['email'];
        $user = User::where('email', $email)->first();
        if ($user !== null) {
            return redirect('auth/register')
                ->withInput($input)
                ->withError(t('auth.register.email_already_used'), 'email');
        }

        if ($input['password'] !== $input['password_confirmation']) {
            return redirect('auth/register')
                ->withInput($input)
                ->withError(t('auth.register.password_not_matched'), 'password_confirmation');
        }

        // Create the user account.

        $user = $this->createUser($input);

        // Login the user into the application (without role yet).

        auth()->setPrincipal($user->id, $user->name, $user->role);

        // Send a mail to verify the email address.

        $this->sendMail($user);

        return redirect($this->redirectTo)
            ->withMessage(t('auth.register.email_sent'));
    }

    /**
     * Create a new user entity.
     *
     * @param array $data
     * @return User
     */
    protected function createUser(array $data)
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
            ->subject(t('auth.emails.register.subject'))
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
            abort(Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('email', $email)->where('confirmation_token', $confirmationToken)->first();
        if ($user === null) {
            abort(Response::HTTP_FORBIDDEN, t('auth.register.token_invalid'));
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
            abort(Response::HTTP_FORBIDDEN);
        }

        if (empty($user->confirmation_token)) {
            return redirect($this->redirectTo)
                ->withMessage(t('auth.register.email_already_verified'));
        }

        $this->sendMail($user);

        return redirect($this->redirectTo)
            ->withMessage(t('auth.register.email_sent'));
    }
}
