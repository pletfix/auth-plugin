<?php

namespace Pletfix\Authentication\Controllers\Admin;

use App\Models\User;
use Core\Services\Contracts\Response;

class UserController
{
    /**
     * Lists all users.
     *
     * @return Response
     */
    public function index()
    {
        $input = request()->input();

        $builder = User::builder();

//        $searchTerm = $input['search'];
//        if ($searchTerm) {
//            $builder = $builder->search($searchTerm);
//        }

        $sortby = isset($input['sortby']) ? $input['sortby'] : 'id';
        $order  = isset($input['order'])  ? $input['order']  : 'ASC';
        if ($sortby && $order) {
            $builder->orderBy($sortby . ' ' . $order);
        }

//        $itemsPerPage = 20;
//        $users = $builder->paginate($itemsPerPage)->appends($input);
        $users = collect($builder->all());

        return view('admin.users.index', compact('users'));
    }

    /**
     * Shows the form to create a new user.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.users.form', ['user' => new User]);
    }

    /**
     * Stores a new user to the database.
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->input();

//        $validation = Validator::make($input, str_replace('{id}', null, User::$rules)); // todo!!
//        if (!$validation->passes()) {
//            return redirect('admin/users')
//                ->flashError(!Fehlerhafte Eingabe')
//                ->flashInput($input);
//        }

        if ($input['password'] !== $input['password_confirmation']) {
            unset($input['password']);
            unset($input['password_confirmation']);
            return redirect('admin/users/create', [], [
                'errors.password_confirmation' => 'Das Kennwort stimmt nicht überein.',
                'input' => $input,
            ]);
        }

        $input['password'] = bcrypt($input['password']);
        unset($input['password_confirmation']);
        unset($input['_method']);
        unset($input['_token']);
        User::create($input); // todo Was machen wenn es nicht klappt?

        return redirect('admin/users', [], [
            'message' => 'Der Benutzer-Account wurde erstellt.'
        ]);
    }

    /**
     * Deletes a user from the database.
     *
     * @param int $id id of the user to delete
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user === null) {
            abort(HTTP_STATUS_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        $user->delete(); // todo Was machen wenn es nicht klappt?

        return redirect('admin/users', [], [
            'message' => 'Der Benutzer-Account wurde gelöscht.'
        ]);
    }

    /**
     * Shows the edit view and gathers the old data.
     *
     * @param int $id id of the user to edit
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if ($user === null) {
            abort(HTTP_STATUS_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        return view('admin.users.form', ['user' => $user]);
    }

    /**
     * Clones the given model and shows the edit view.
     *
     * @param int $id id of the user to replicate
     * @return Response
     */
    public function replicate($id)
    {
        $user = User::find($id);

        if ($user === null) {
            abort(HTTP_STATUS_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        $user = $user->replicate();

        return view('admin.users.form', ['user' => $user]);
    }

    /**
     * Stores an user to the database.
     *
     * @param int $id id of the user to store
     * @return Response
     */
    public function update($id)
    {
        $user = User::find($id);

        if ($user === null) {
            abort(HTTP_STATUS_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        $input = request()->input();
        //$validation = Validator::make($input, str_replace('{id}', $user->id, User::$rules));
//        if (!$validation->passes()) {
//            return redirect('admin.users.edit', $id)->withInput()->flashErrors($validation);
//        }
        if (!empty($input['password'])) {
            if ($input['password'] !== $input['password_confirmation']) {
                unset($input['password']);
                unset($input['password_confirmation']);
                return redirect('admin/users/' . $id . '/edit', [], [
                    'errors.password_confirmation' => 'Das Kennwort stimmt nicht überein.',
                    'input' => $input,
                ]);
            }
            $input['password'] = bcrypt($input['password']);
        }
        else {
            unset($input['password']);
        }

        unset($input['password_confirmation']);
        unset($input['_method']);
        unset($input['_token']);

        $user->update($input);

        return redirect('admin/users', [], [
            'message' => 'Der Benutzer-Account wurde aktualisiert.'
        ]);
    }

    /**
     * Shows a single user.
     *
     * @param int $id id of the user to show
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user === null) {
            abort(HTTP_STATUS_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Confirms the email address.
     *
     * @param int $id
     * @return Response
     */
    public function confirm($id)
    {
        $user = User::find($id);

        if ($user === null) {
            abort(HTTP_STATUS_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        $user->confirmation_token = null;
        $user->save();

        return redirect('admin/users', [], [
            'message' => 'Echtheit der E-Mail-Adresse bestätigt.'
        ]);
    }
}