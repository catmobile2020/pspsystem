<?php

namespace App\Http\Controllers;

use App\Company;
use App\Helpers\UploadImage;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use UploadImage;

    public function index(Request $request)
    {
        $rows = Company::latest()->paginate(20);
        return view('pages.company.index',compact('rows'));
    }

    public function create()
    {
        $company = new Company;
        return view('pages.company.form',compact('company'));
    }


    public function store(CompanyRequest $request)
    {
        $company =Company::create($request->except('photo'));
        if ($request->photo) {
            $this->upload($request->photo,$company);
        }
        return redirect()->route('companies.index')->with('message','Done Successfully');
    }

    public function edit(Company $company)
    {
        return view('pages.company.form',compact('company'));
    }


    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->except('photo'));
        if ($request->photo) {
            $this->upload($request->photo,$company,null,true);
        }
        return redirect()->route('companies.index')->with('message','Done Successfully');
    }


    public function destroy(Company $company)
    {
        $company->trash();
        return redirect()->route('companies.index')->with('message','Done Successfully');
    }
}
