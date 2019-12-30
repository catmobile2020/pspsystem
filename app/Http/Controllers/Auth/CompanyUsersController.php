<?php

namespace App\Http\Controllers\Auth;

use App\CompanyUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:marketing')->except('logout');
    }

    public function index()
    {
        return view('pages.auth.marketing-login');
    }

    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $row = CompanyUsers::where(function ($q) use ($username){
            $q->where('username',$username)->orWhere('email',$username);
        })->first();
        if ($row)
        {
            if (Hash::check($request->password,$row->password))
            {
                auth('marketing')->login($row,$request->remember);
                return redirect()->intended('/marketing');
            }
        }
        return redirect()->back()->with('message','Error Your Credential is Wrong');
    }

    public function logout()
    {
        auth()->guard('marketing')->logout();
        request()->session()->invalidate();
        return redirect()->route('user.login');
    }
}
