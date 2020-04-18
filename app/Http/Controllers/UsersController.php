<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        if(!User::userCan(['browse_user']))
        {
            abort(404);
        }
        $users = User::with('roles')->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if(!User::userCan(['add_user']))
        {
            abort(404);
        }
        $roles = Roles::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->passeword);    
        $user->role_id = $request->role;
        $user->save();
        return redirect(route('users.edit',['user'=>$user->id]))->with('status','Saved!');
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
        if(!User::userCan(['edit_user']))
        {
            abort(404);
        }
        $user = User::find($id);
        $roles = Roles::all();
        return view('users.edit',compact('user','roles'));
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
            'email' => 'required|email'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null)
        {
            $user->password = Hash::make($request->passeword);    
        }
        
        $user->role_id = $request->role;
        $user->update();
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
        $user = User::find($id);
        $user->delete();
        return back()->with('status','Saved!');
    }

    public function change_password_index()
    {
        $userId = Auth::user()->id;
        return view('users.change-password',compact('userId'));
    }

    public function change_password(Request $request,$id)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);   
        $user->save();
        Auth::logout();
        return redirect('/login');
    }
}
