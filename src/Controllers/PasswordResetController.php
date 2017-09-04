<?php

namespace Pletfix\Auth\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use Core\Services\Contracts\Response;

/**
 * This controller is responsible for handling password reset requests.
 */
class PasswordResetController extends Controller
{
    /**
     * Where to redirect users after reset password.
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
     * Display the form to request a password reset link.
     *
     * @return Response
     */
    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    /**
     * Send a reset link to the given user.
     *
     * @return Response
     */
    public function send()
    {
        $input = request()->input();

        // Validate the input.
        if (empty($input['email'])) {
            return redirect('auth/reset')
                ->withInput($input)
                ->withError('E-Mail-Adresse ist erforderlich.', 'email');
        }

        $email = $input['email'];
        $user = User::where('email', $email)->first();
        if ($user === null) {
            return redirect('auth/reset')
                ->withInput($input)
                ->withError('That email address doesn\'t match any user accounts. Are you sure you\'ve registered?', 'email');
        }

        $this->sendMail($user, $this->createToken($email));

        return redirect($this->redirectTo)
            ->withMessage('Eine E-Mail zum Zurücksetzen des Kennworts wurde versendet');
    }

    /**
     * Create a token and save it in the database.
     *
     * @param string $email
     * @return string
     */
    protected function createToken($email)
    {
        $token = random_string(60);
        database()->table('password_resets')->insert(compact('email', 'token'));

        return $token;
    }

    /**
     * Send an email to the user for verification the email address.
     *
     * @param User $user
     * @param string $token
     */
    protected function sendMail(User $user, $token)
    {
        mailer()
            ->subject('Your Password Reset Link')
            ->to($user->email, $user->name)
            ->view('auth.emails.reset', compact('user', 'token'))
            ->send();
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param string $token
     * @return Response
     */
    public function showResetForm($token)
    {
        $email = request()->input('email');
        if (!empty($email)) {
            // There is probably a request from the reset email. Determine if the link is still valid.
            $this->checkToken($email, $token);
        }

        return view('auth.reset', ['token' => $token, 'email' => $email]);
    }

    /**
     * Reset the given user's password.
     *
     * @return Response
     */
    public function reset()
    {
        $input = request()->input();

        // Validate the input.

        $email = $input['email'];
        $token = $input['token'];
        $this->checkToken($email, $token);

        if ($input['password'] !== $input['password_confirmation']) {
            return redirect('auth/reset/' . $token)
                ->withInput($input)
                ->withError('Das Kennwort stimmt nicht überein.', 'password_confirmation');
        }

        // Reset the password.

        /** @var User $user */
        $user = User::where('email', $email)->first();
        if ($user === null) {
            abort(Response::HTTP_BAD_REQUEST);
        }
        $user->password = bcrypt($input['password']);
        $user->save();
        database()->table('password_resets')->where('email', $email)->delete();

        // Login the user

        auth()->setPrincipal($user->id, $user->name, $user->role);

        return redirect($this->redirectTo)
            ->withMessage('Dein Kennwort wurde geändert!');
    }

    /**
     * Check the token.
     *
     * If the token is not valud, the request is aborted.
     *
     * @param $email
     * @param $token
     */
    protected function checkToken($email, $token)
    {
        $rs = database()->table('password_resets')->where('email', $email)->where('token', $token)->first();
        if ($rs === null) {
            abort(Response::HTTP_FORBIDDEN, 'Token is invalid.');
        }
    }

}
