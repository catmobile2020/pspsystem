<?php

namespace App\Http\Controllers;

use App\CallCenter;
use App\Company;
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
        $companies = Company::all();
        $products = Product::all();
        return view('pages.callcenter.form',compact('callcenter','companies','products'));
    }


    public function store(CallCenterRequest $request)
    {
        CallCenter::create($request->all());
        return redirect()->route('callcenters.index')->with('message','Done Successfully');
    }

    public function edit(CallCenter $callcenter)
    {
        $companies = Company::all();
        $products = Product::all();
        return view('pages.callcenter.form',compact('callcenter','companies','products'));
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

    public function companyProducts(Company $company)
    {
         $products = $company->products;
         $element = '<label for="title">Product</label>
                                    <select name="product_id" class="form-control">
                                        <option selected value>Select Product</option>';

            foreach($products as $product)
                $element.='<option value="{{$product->id}}">'.$product->name.'</option>';

           $element.='</select>';
         return $element;
    }
}
