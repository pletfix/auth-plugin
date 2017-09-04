<?php

namespace Pletfix\Auth\Controllers;

use App\Models\User;
use Core\Services\Contracts\Response;
use Core\Services\PDOs\Builders\Contracts\Builder;

class UserManagerController
{
    /**
     * Lists all users.
     *
     * @return Response
     */
    public function index()
    {
        $input = request()->input();

        /** @var Builder $builder */
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

        $paginator = paginator($builder->count(), 20);
        $users = collect($builder->offset($paginator->offset())->limit($paginator->limit())->all());

        return view('auth.users.index', compact('paginator', 'users'));
    }

    /**
     * Shows the form to create a new user.
     *
     * @return Response
     */
    public function create()
    {
        return view('auth.users.form', ['user' => new User]);
    }

    /**
     * Stores a new user to the database.
     *
     * @return Response
     */
    public function store()
    {
        $input = request()->input();

        if ($input['password'] !== $input['password_confirmation']) {
            unset($input['password']);
            unset($input['password_confirmation']);
            return redirect('auth/users/create')
                ->withInput($input)
                ->withError('Das Kennwort stimmt nicht überein.', 'password_confirmation');
        }

        $input['password'] = bcrypt($input['password']);
        unset($input['password_confirmation']);
        unset($input['_method']);
        unset($input['_token']);

        if (User::create($input) === false) {
            return redirect('auth/users')
                ->withError('Unable to create the user account.');
            //throw new RuntimeException('Unable to create user account.');
        };

        return redirect('auth/users')
            ->withMessage('Der Benutzer-Account wurde erstellt.');
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
            abort(Response::HTTP_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        if (!$user->delete()) {
            return redirect('auth/users')
                ->withError('Unable to create the user account.');
            //throw new RuntimeException('Unable to delete the user account.');
        };

        return redirect('auth/users')
            ->withMessage('Der Benutzer-Account wurde gelöscht.');
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
            abort(Response::HTTP_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        return view('auth.users.form', ['user' => $user]);
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
            abort(Response::HTTP_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        $user = $user->replicate();

        return view('auth.users.form', ['user' => $user]);
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
            abort(Response::HTTP_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        $input = request()->input();
        //$validation = Validator::make($input, str_replace('{id}', $user->id, User::$rules));
//        if (!$validation->passes()) {
//            return redirect('auth.users.edit', $id)->withInput()->withErrors($validation);
//        }
        if (!empty($input['password'])) {
            if ($input['password'] !== $input['password_confirmation']) {
                unset($input['password']);
                unset($input['password_confirmation']);
                return redirect('auth/users/' . $id . '/edit')
                    ->withInput($input)
                    ->withError('Das Kennwort stimmt nicht überein.', 'password_confirmation');
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

        return redirect('auth/users')
            ->withMessage('Der Benutzer-Account wurde aktualisiert.');
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
            abort(Response::HTTP_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        return view('auth.users.show', compact('user'));
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
            abort(Response::HTTP_BAD_REQUEST, 'User #' . $id . ' not found!');
        }

        $user->confirmation_token = null;
        $user->save();

        return redirect('auth/users')
            ->withMessage('Echtheit der E-Mail-Adresse bestätigt.');
    }
}