<?php

namespace App\Http\Controllers;

use App\Governorate;
use App\Http\Requests\PharmacyRequest;
use App\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {
        $rows = Pharmacy::latest()->paginate(20);
        return view('pages.pharmacy.index',compact('rows'));
    }

    public function create()
    {
        $pharmacy = new Pharmacy();
        $governorates = Governorate::all();
        return view('pages.pharmacy.form',compact('pharmacy', 'governorates'));
    }


    public function store(PharmacyRequest $request)
    {
        $inputs = $request->all();
        Pharmacy::create($inputs);
        return redirect()->route('pharmacies.index')->with('message','Done Successfully');
    }

    public function edit(Pharmacy $pharmacy)
    {
        $governorates = Governorate::all();
        return view('pages.pharmacy.form',compact('pharmacy', 'governorates'));
    }


    public function update(PharmacyRequest $request, Pharmacy $pharmacy)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $pharmacy->update($request->all());
        return redirect()->route('pharmacies.index')->with('message','Done Successfully');
    }


    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return redirect()->route('pharmacies.index')->with('message','Done Successfully');
    }
}
