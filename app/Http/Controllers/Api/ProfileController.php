<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UploadImage;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\AccountResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CardResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use UploadImage;

    public function __construct()
    {
//        $guard = explode('/',request()->route()->uri())[2];
        $guard = request()->guard;
        auth()->shouldUse($guard);
        $this->middleware('auth:'.$guard);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"account"},
     *      path="/account/{guard}/me",
     *      summary="Get the current logged in user",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="guard",
     *         in="path",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="userApi",
     *         description="userApi , companyApi , pharmacyAdminApi , pharmacyUsersApi ",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function me()
    {
        return AccountResource::make(auth()->user());
    }

    /**
     *
     * @SWG\Get(
     *      tags={"account"},
     *      path="/account/{guard}/my-product",
     *      summary="Get my product",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="guard",
     *         in="path",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="userApi",
     *         description="userApi , companyApi , pharmacyAdminApi , pharmacyUsersApi ",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function accountProduct()
    {
        $product = auth()->user()->callCenter->product;
        return ProductResource::make($product);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"account (doctor)"},
     *      path="/account/userApi/my-patients-cards",
     *      summary="Get my product",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function myPatientsCards()
    {
        $product = auth()->user()->cards()->paginate($this->api_paginate_num);
        return CardResource::make($product);
    }

    /**
     *
     * @SWG\post(
     *      tags={"account"},
     *      path="/account/{guard}/update",
     *      summary="update My Account",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="guard",
     *         in="path",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="userApi",
     *         description="userApi , companyApi , pharmacyAdminApi , pharmacyUsersApi ",
     *      ),
     *      @SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="mahmoud",
     *      ),@SWG\Parameter(
     *         name="email",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="rep1@gmail.com",
     *      ),@SWG\Parameter(
     *         name="photo",
     *         in="formData",
     *         type="file",
     *      ),@SWG\Parameter(
     *         name="national_id",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="age",
     *         in="formData",
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="sex",
     *         in="formData",
     *         type="integer",
     *         description="1=>male , 2=>Female",
     *      ),@SWG\Parameter(
     *         name="address",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="phone",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="phone2",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="diagnosis",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="specialty",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="preferred_distributor",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="token"),
     *      @SWG\Response(response=400, description="Unauthorized"),
     * )
     * @param RegisterRequest $request
     * @return AccountResource
     */
    public function update(RegisterRequest $request)
    {
        $user = auth()->user();
        $user->update($request->all());
        if ($request->photo)
            $this->upload($request->photo,$user,null,true);
        return AccountResource::make(auth()->user());
    }

    /**
     *
     * @SWG\post(
     *      tags={"account"},
     *      path="/account/{guard}/update-password",
     *      summary="update My Password",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="guard",
     *         in="path",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="userApi",
     *         description="userApi , companyApi , pharmacyAdminApi , pharmacyUsersApi ",
     *      ),
     *      @SWG\Parameter(
     *         name="current_password",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="password",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="User Model"),
     *      @SWG\Response(response=400, description="Unauthorized"),
     * )
     * @param Request $request
     * @return AccountResource|\Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        if (Hash::check($request->current_password,$user->password))
        {
            if ($request->current_password === $request->password)
            {
                return $this->responseJson('Current And New Password is Same',400);
            }
            $user->update(['password'=>$request->password]);

            return AccountResource::make($user);
        }
        return $this->responseJson('Current Password Wrong',400);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"account"},
     *      path="/account/{guard}/my-products",
     *      summary="get my account products",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="guard",
     *         in="path",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="userApi",
     *         description="userApi , companyApi , pharmacyAdminApi , pharmacyUsersApi ",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function companyProducts()
    {
        $user = auth()->user();
        if ($user->type == 1)
        {
            $company=$user->company;
            if ($company)
            {
                $rows = $company->products()->latest()->with('orders')->paginate($this->api_paginate_num);
                return ProductResource::collection($rows);
            }
           return null;
        }
        $row = $user->product;
        return ProductResource::make($row);
    }

}
