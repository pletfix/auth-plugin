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
                ->withError('E-Mail-Adresse oder Kennwort ist nicht korrekt.');
        }

        $url = session('origin_url', url($this->redirectTo));

        return response()->redirect($url);
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function logout()
    {
        auth()->logout();

        return redirect($this->redirectTo);
    }
}
