<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;
class ProfileController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
/**
     * Get a validator for an incoming registration request.
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|max:255|unique:users',
            'email' => 'required|string|max:255|unique:users',
            'gender' => 'required|string|max:255',
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user=Auth::user();
        //dd($user);
        return view('profile',compact(['id',$user->id],['user',$user]));
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
       // User::where('id',  $id)->update(array_except($request->all(), ['_token','_method','password_confirmation']));

        $user = User::find($id);

        $user->name = $request->get('name');
        $user->national_id = $request->get('national_id');
        $user->email = $request->get('email');
        $user->gender = $request->get('gender');

        if ( !$request->get('password')==null)
        {
            $user->password = Hash::make($request->get('password'));
        }
        
        $user->save();

/*
        User::where('id',  $id)->update(
            ['name' => $request->get('name'),
            'national_id' => $request->get('national_id'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'gender' => $request->get('gender')
            ]
        );*/
      return  redirect()->route('home');


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
    }
}
