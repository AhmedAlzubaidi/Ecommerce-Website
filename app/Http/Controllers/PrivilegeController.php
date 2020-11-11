<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrivilegeRequest;
use App\Privilege;

class PrivilegeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Privilege::class, 'privilege');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Privilege::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\PrivilegeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrivilegeRequest $request)
    {
        $privilege = new Privilege();
        $privilege->name = $request->input('name');
        $privilege->save();

        return $privilege;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function show(Privilege $privilege)
    {
        return $privilege;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\PrivilegeRequest  $request
     * @param  \App\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function update(PrivilegeRequest $request, Privilege $privilege)
    {
        $privilege->name = $request->input('name');
        $privilege->save();

        return $privilege;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy(Privilege $privilege)
    {
        return $privilege->delete();
    }
}
