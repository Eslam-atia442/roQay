<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public  function login() {
        return view('user.auth.login');
    }
    public function postLogin(AuthRequest $request)
    {

        $credentials= $request->validated();
        unset($request['_token']);
        if (Auth::guard('user')->attempt($credentials)) {
            return redirect(route('user.home'));
        }

        return ('Oppes! You have entered invalid credentials');
    }

    public function logout()
    {
        Auth('user')->logout();
        return Redirect()->route('user.login.page');
    }
}
