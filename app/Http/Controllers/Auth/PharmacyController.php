<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PharmacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:pharmacy')->except('logout');
    }

    public function index()
    {
        return view('pages.auth.pharmacy-login');
    }

    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $row = Pharmacy::where(function ($q) use ($username){
            $q->where('username',$username)->orWhere('email',$username);
        })->first();
        if ($row)
        {
            if (Hash::check($request->password,$row->password))
            {
                auth('pharmacy')->login($row,$request->remember);
                return redirect()->intended('/pharmacy');
            }
        }
        return redirect()->back()->with('message','Error Your Credential is Wrong');
    }

    public function logout()
    {
        auth()->guard('pharmacy')->logout();
        request()->session()->invalidate();
        return redirect()->route('pharmacy.login');
    }
}
