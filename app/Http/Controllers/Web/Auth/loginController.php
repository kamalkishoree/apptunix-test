<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\Request;

class loginController extends Controller
{

    public function index()
    {
        if (auth()->user()) {
            return view("auth.userDashboard");

        }
        else
        {
            return view("auth.login");
        }
    }
    public function login(LoginRequest $request)
    {
        print_r($request->all());
        die;
        $credentials= $request->only("email","password");
        if(Auth::attempt($credentials))
        {
            return redirect()->route("user.dashboard");
        }
        else
        {
            authlLog("invalide login attempt",$request->email);
            return redirect()->back()->with("error","Wrong Credentials");
        }
    }
}
