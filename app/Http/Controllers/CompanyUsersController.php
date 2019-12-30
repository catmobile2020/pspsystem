<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyUsers;
use App\Http\Requests\CompanyUsersRequest;
use App\Product;

class CompanyUsersController extends Controller
{
    public function index(Company $company)
    {
        $rows = $company->users()->latest()->paginate(20);
        return view('pages.company.user.index',compact('company','rows'));
    }

    public function create(Company $company)
    {
        $marketing = new CompanyUsers();
        $products = Product::all();
        return view('pages.company.user.form',compact('company','marketing','products'));
    }


    public function store(Company $company,CompanyUsersRequest $request)
    {
        $company->users()->create($request->all());
        return redirect()->route('marketing.index',$company->id)->with('message','Done Successfully');
    }

    public function edit(Company $company,CompanyUsers $marketing)
    {
        $products = Product::all();
        return view('pages.company.user.form',compact('company','marketing','products'));
    }


    public function update(Company $company,CompanyUsersRequest $request, CompanyUsers $marketing)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $inputs = $request->all();
        $marketing->update($inputs);
        return redirect()->route('marketing.index',$company->id)->with('message','Done Successfully');
    }


    public function destroy(Company $company,CompanyUsers $marketing)
    {
        $marketing->delete();
        return redirect()->route('marketing.index',$company->id)->with('message','Done Successfully');
    }
}
