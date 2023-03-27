<?php

namespace App\Http\Controllers;

use App\CallCenter;
use App\Http\Requests\CallCenterRequest;
use App\Product;
use App\Program;
use Illuminate\Http\Request;

class CallCenterController extends Controller
{
    public function index(Request $request)
    {
        $rows = CallCenter::latest()->paginate(20);
        return view('pages.callcenter.index',compact('rows'));
    }

    public function create()
    {
        $callcenter = new CallCenter;
        $products = Product::all();
        return view('pages.callcenter.form',compact('callcenter','products'));
    }


    public function store(CallCenterRequest $request)
    {
        CallCenter::create($request->all());
        return redirect()->route('callcenters.index')->with('message','Done Successfully');
    }

    public function edit(CallCenter $callcenter)
    {
        $products = Product::all();
        return view('pages.callcenter.form',compact('callcenter','products'));
    }


    public function update(CallCenterRequest $request, CallCenter $callcenter)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $inputs = $request->all();
        $callcenter->update($inputs);
        return redirect()->route('callcenters.index')->with('message','Done Successfully');
    }


    public function destroy(CallCenter $callcenter)
    {
        $callcenter->delete();
        return redirect()->route('callcenters.index')->with('message','Done Successfully');
    }
}
