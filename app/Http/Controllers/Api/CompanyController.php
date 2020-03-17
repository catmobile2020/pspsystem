<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    /**
     *
     * @SWG\Get(
     *      tags={"companies"},
     *      path="/companies",
     *      summary="get all companies paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $patients = Company::paginate($this->api_paginate_num);
        return CompanyResource::collection($patients);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"companies"},
     *      path="/companies/{company}",
     *      summary="get single company",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="company",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Company $company
     * @return CompanyResource
     */
    public function show(Company $company)
    {
        return CompanyResource::make($company);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"companies"},
     *      path="/companies/{company}/products",
     *      summary="get single company products paginated",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="company",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Company $company
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function companyProducts(Company $company)
    {
        $rows = $company->products()->latest()->with('orders')->paginate($this->api_paginate_num);
        return ProductResource::collection($rows);
    }
}
