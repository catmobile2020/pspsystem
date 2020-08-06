<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UsersResource;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"products"},
     *      path="/products",
     *      summary="get all products paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = Product::with('orders')->paginate($this->api_paginate_num);
        return ProductResource::collection($rows);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"products"},
     *      path="/products/{product}",
     *      summary="get single product",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"products"},
     *      path="/products/{product}/patients",
     *      summary="get single product patients paginated",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Product $product
     * @return UsersResource
     */
    public function productPatients(Product $product)
    {
        $call_centers_ids = $product->callCenters()->pluck('id')->toArray();
        $rows = User::where('type',1)->whereIn('call_center_id',$call_centers_ids)->paginate($this->api_paginate_num);
        return UsersResource::collection($rows);
    }
}
