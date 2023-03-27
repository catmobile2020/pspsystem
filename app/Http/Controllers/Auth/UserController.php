<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function index()
    {
        return view('pages.auth.user-login');
    }

    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $row = User::where(function ($q) use ($username){
            $q->where('username',$username)->orWhere('email',$username);
        })->first();
        if ($row)
        {
            if (Hash::check($request->password,$row->password))
            {
                auth()->guard('web')->login($row,$request->remember);
                return redirect()->intended('/users');
            }
        }
        return redirect()->back()->with('message','Error Your Credential is Wrong');
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        request()->session()->invalidate();
        return redirect()->route('user.login');
    }
}
