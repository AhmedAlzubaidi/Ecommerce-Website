<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return User::paginate(10);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return $user->loadAll();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->full_name = $request->input('full_name');

        if ($request->has('role')) {
            $role = Role::where('name', $request->input('role'))->first();
            $user->role()->associate($role);
        }
        
        return $user->loadAll();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        return $user->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAddress(AddressRequest $request)
    {
        $this->authorize('create', Address::class);
        $city = City::where('id', $request->input('city_id'))->first();

        $address = new Address();
        $address->user()->associate($request->user());
        
        if ($city) {
            $address->city()->associate($city);
        }
        
        $address->address     = $request->input('address');
        $address->apartment   = $request->input('apartment');
        $address->postal_code = $request->input('postal_code');
        $address->save();

        return $address;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function updateAddress(AddressRequest $request, Address $address)
    {
        $this->authorize('update', $address);
        $address->address     = $request->input('address');
        $address->apartment   = $request->input('apartment');
        $address->postal_code = $request->input('postal_code');
        $address->save();

        return $address;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroyAddress(Address $address)
    {
        $this->authorize('delete', $address);
        return $address->delete();
    }

    public function attachRole(User $user, Role $role)
    {
        $this->authorize('attach', $role);
        $user->role()->associate($role);
        $user->save();

        return $user->role();
    }

    public function detachRole(User $user, Role $role)
    {
        $this->authorize('detach', $role);
        $user->role()->dissociate($role);
        $user->save();
        // * we don't need to reload users for now
        // * because we don't retrieve users from a role ever
        // * $role->load('users'); $role->users()

        return $user;
    }
}
