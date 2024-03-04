<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $loginData = $request ->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)){
            return response([
                'response' => 'Invalid Credentials',
                'message' => 'error'
            ]);
        }

        $accessToken = auth()->user()->createToken('authToken')-> accessToken;
        
        return response([
            'token'=>$accessToken,  
            'profile'=>auth()->user(),  
            'message'=>'success'
        ]);
        
    }

    public function logout(Request $request) {
        
    }
}
