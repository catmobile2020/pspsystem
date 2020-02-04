<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\PharmacyUsers;
use Illuminate\Support\Facades\Hash;

class PharmacyUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:pharmacyUsers')->except('logout');
    }

    public function index()
    {
        return view('pages.auth.pharmacyUsers-login');
    }

    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $row = PharmacyUsers::where(function ($q) use ($username){
            $q->where('username',$username)->orWhere('email',$username);
        })->first();
        if ($row)
        {
            if (Hash::check($request->password,$row->password))
            {
                auth('pharmacyUsers')->login($row,$request->remember);
                return redirect()->intended('/pharmacyUsers');
            }
        }
        return redirect()->back()->with('message','Error Your Credential is Wrong');
    }

    public function logout()
    {
        auth()->guard('pharmacyUsers')->logout();
        request()->session()->invalidate();
        return redirect()->route('pharmacyUsers.login');
    }
}
