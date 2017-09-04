<?php

namespace Pletfix\Auth\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use Core\Services\Contracts\Response;

/**
 * This controller is responsible for handling password change requests.
 */
class PasswordChangeController extends Controller
{
    /**
     * Where to redirect users after change password.
     *
     * @var string
     */
    protected $redirectTo = '';

//    /**
//     * Create a new password change controller instance.
//     */
//    public function __construct()
//    {
//    }

    /**
     * Display the password change view.
     *
     * @return Response
     */
    public function showForm()
    {
        return view('auth.password');
    }

    /**
     * Handle a password change request for the application.
     *
     * @return Response
     */
    function change()
    {
        $user = User::find(auth()->id());
        if ($user === null) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $input = request()->input();

        if ($user === null || !password_verify($input['old_password'], $user->password)) {
            return redirect('auth/password')
                ->withError('Das Kennwort ist nicht korrekt.', 'errors.old_password');
        }

        if ($input['password'] !== $input['password_confirmation']) {
            return redirect('auth/password')
                ->withError('Das Kennwort stimmt nicht überein.', 'password_confirmation');
        }

        $user->password = bcrypt($input['password']);
        $user->save();

        return redirect($this->redirectTo)
            ->withMessage('Dein Kennwort wurde geändert!');
    }
}