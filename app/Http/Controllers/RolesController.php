<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use App\Permission;
use App\User;


class RolesController extends Controller
{
    public function index()
    {
        if(!User::userCan(['browse_roles']))
        {
            abort(404);
        }

        $roles = Roles::all();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!User::userCan(['add_roles']))
        {
            abort(404);
        }
        //
        $roles = Roles::all();
        return view('roles.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!User::userCan(['edit_roles']))
        {
            abort(404);
        }
        $role = Roles::find($id);
        $permissions = Permission::all();
        return view('roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'name' => 'required',
        ]);

        $role = Roles::find($id);
        $role->name = $request->name;        
        $role->permissions = json_encode($request->permission);
        $role->update();
        return back()->with('status','Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $role = Roles::find($id);
        $role->delete();
        return back()->with('status','Saved!');
    }
}
