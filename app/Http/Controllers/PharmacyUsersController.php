<?php

namespace App\Http\Controllers;

use App\Http\Requests\PharmacyUsersRequest;
use App\Pharmacy;
use App\PharmacyUsers;

class PharmacyUsersController extends Controller
{
    public function index()
    {
        $pharmacy = auth('pharmacy')->user();
        $rows = $pharmacy->users()->latest()->paginate(20);
        return view('pages.pharmacy.user.index',compact('pharmacy','rows'));
    }

    public function create()
    {
        $pharmacy = auth('pharmacy')->user();
        $user = new PharmacyUsers();
        return view('pages.pharmacy.user.form',compact('pharmacy','user'));
    }


    public function store(PharmacyUsersRequest $request)
    {
        $pharmacy = auth('pharmacy')->user();
        $pharmacy->users()->create($request->all());
        return redirect()->back()->with('message','Done Successfully');
    }

    public function edit(PharmacyUsers $user)
    {
        $pharmacy = auth('pharmacy')->user();
        return view('pages.pharmacy.user.form',compact('pharmacy','user'));
    }


    public function update(PharmacyUsersRequest $request, PharmacyUsers $user)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $inputs = $request->all();
        $user->update($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function destroy(PharmacyUsers $user)
    {
        $user->delete();
        return redirect()->back()->with('message','Done Successfully');
    }

    public function pharmacistOrders(PharmacyUsers $user)
    {
        $rows = $user->orders()->latest()->paginate(15);
        return view('pages.order.index',compact('rows'));
    }
}
