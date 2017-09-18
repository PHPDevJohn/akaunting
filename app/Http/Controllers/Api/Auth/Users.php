<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\User as Request;
use App\Http\Transformers\Auth\User as Transformer;
use App\Models\Auth\User;
use Dingo\Api\Routing\Helpers;

class Users extends ApiController
{
    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $users = User::with(['roles', 'permissions'])->collect();

        return $this->response->paginator($users, new Transformer());
    }

    /**
     * Display the specified resource.
     *
     * @param  int|string  $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id)
    {
        // Check if we're querying by id or email
        if (is_numeric($id)) {
            $user = User::with(['roles', 'permissions'])->findOrFail($id);
        } else {
            $user = User::with(['roles', 'permissions'])->where('email', $id)->first();
        }

        return $this->response->item($user, new Transformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->input());

        if ($request->has('roles')) {
            $user->roles()->attach($request->get('roles'));
        }

        if ($request->has('companies')) {
            $user->companies()->attach($request->get('companies'));
        }

        return $this->response->created(url('api/users/'.$user->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $user
     * @param  $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(User $user, Request $request)
    {
        // Except password as we don't want to let the users change a password from this endpoint
        $user->update($request->except('password'));

        if ($request->has('roles')) {
            $user->roles()->attach($request->get('roles'));
        }

        if ($request->has('companies')) {
            $user->companies()->attach($request->get('companies'));
        }

        return $this->response->item($user->fresh(), new Transformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Dingo\Api\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->response->noContent();
    }
}
