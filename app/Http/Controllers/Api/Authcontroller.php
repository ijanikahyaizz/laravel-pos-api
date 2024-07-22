<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    // register user
    public function register(Request $request)
    {
        $request ->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string',
            'roles'=>'required|string|in:admin,kasir'
        ]);


        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'roles'=>$request->roles,
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>'user registered',
            'data'=>$user
        ],201);





    }

// login
public function login(Request $request)
{
    $request->validate([
        'email'=>'required|email',
            'password'=>'required|string',
    ]);


    $user = User::where('email',$request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
         return response()->json(['status'=>'failed', 'message'=>'The provided credentials are incorrect.'],401);
    }

    $token = $user->createToken('token-name')->plainTextToken;


        return response()->json([
            'status'=>'success',
            'message'=>'user logged in',
            'data'=>[
                'user'=>$user,
                'token'=>$token
            ]
        ],200);


}

// logout

public function logout (Request $request)
{
    $request->user()->currentAccessToken()->delete();


        return response()->json([
            'status'=>'success',
            'message'=>'Token revoked',
        ],200);
}


}
