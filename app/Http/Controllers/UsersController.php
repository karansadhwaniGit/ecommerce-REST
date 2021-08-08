<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }
    public function store(Request $request)
    {
        $rules=[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed'
        ];
        $this->validate($request,$rules);

        $data= $request->all();
        $data['password']=bcrypt($request->password);
        $data['verified']=User::UNVERIFIED_USER;
        $data['verification_token']=User::generateVerficationCode();
        $data['admin']=User::REGULAR_USER;

        $user= User::create($data);

        return $this->shwoOne($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    public function update(Request $request,User $id)
    {
        $rules=[
            'name'=>'min:5',
            'email'=>'email|unique:users',
            'password'=>'min:8|confirmed',
            'admin'=>'in'.User::REGULAR_USER. ',' . User::ADMIN_USER
        ];
        $this->validate($request,$rules);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['data'=>$user],200);
    }
}
