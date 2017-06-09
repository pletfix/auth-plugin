<?php

namespace Pletfix\Authentication\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Core\Services\Contracts\Response;

/**
 * This controller is responsible for handling password change requests.
 */
class PasswordController extends Controller
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
            abort(HTTP_STATUS_FORBIDDEN);
        }

        $input = request()->input();

        // todo!
//        $validator =  Validator::make($inputs, array_only($user->getRules(), 'password'));
//        if ($validator->fails()) {
//            return redirect()->back()->withInput()->withErrors($validator);
//        }

        if ($user === null || !password_verify($input['old_password'], $user->password)) { // todo entfällt evtl., wenn Validator realisiert ist
            return redirect('auth/password', [], [
                'errors.old_password' => 'Das Kennwort ist nicht korrekt.',
                //'input' => $input,
            ]);
        }

        if ($input['password'] !== $input['password_confirmation']) { // todo entfällt, wenn Validator realisiert ist
            return redirect('auth/password', [], [
                'errors.password_confirmation' => 'Das Kennwort stimmt nicht überein.',
                //'input' => $input,
            ]);
        }

        $user->password = bcrypt($input['password']);
        $user->save();

        return redirect($this->redirectTo, [], ['message' => 'Dein Kennwort wurde geändert!']);
    }
}