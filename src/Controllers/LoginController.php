<?php

namespace Pletfix\Auth\Controllers;

use App\Controllers\Controller;
use Core\Services\Contracts\Response;

/**
 * This controller handles authentication users for the application and redirecting them to your home screen.
 */
class LoginController extends Controller
{
    /**
     * Where to redirect users after login or logout.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Show the application's login form.
     *
     * @return Response
     */
    public function showForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @return Response
     */
    public function login()
    {
        $input = request()->input();

        if (!auth()->login($input)) {
            unset($input['password']);
            return redirect('auth/login')
                ->withInput($input)
                ->withError(t('auth.login.failed'));
        }

        $url = session('origin_url', url($this->redirectTo));

        return response()->redirect($url);
    }

    /**
     * Log off the user from the application.
     *
     * @return Response
     */
    public function logout()
    {
        auth()->logout();

        if (isset($_SERVER['PHP_AUTH_PW'])) {
            return response()->output(
                '<html>You are logout now!<script>window.location.href = "' . url($this->redirectTo) . '"</script></html>',
                401 // The status code 401 (unauthorized) causes the cached credentials to be cleared by the browser!
            );
        }

        return redirect($this->redirectTo);
    }

    /**
     * Attempt to authenticate using HTTP Basic Authentication.
     *
     * @return Response
     */
    public function basicAuth()
    {
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            $field = config('auth.model.identity');
            auth()->login([
                $field     => $_SERVER['PHP_AUTH_USER'],
                'password' => $_SERVER['PHP_AUTH_PW'],
            ]);
        }

        if (!auth()->isLoggedIn()) {
            // show the HTTP Basic Auth Dialog
            return response()->output(
                '<html>Not authorized!<script>window.location.href = "' . url($this->redirectTo) . '"</script></html>', // text to send if user hits Cancel button
                401,
                ['WWW-Authenticate' => 'Basic realm="' . config('app.name') . '"']
            );
        }

        $url = session('origin_url', url($this->redirectTo));

        return response()->redirect($url);
    }
}
