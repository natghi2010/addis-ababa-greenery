<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Login
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){


        $credentials = $request->only('username','password');

        if(Auth::attempt($credentials)){
            return response()->json(["test"=>"test"],200);
        }else{
            return response()->json(["invalid"=>"test"],400);
        }
    }


}
