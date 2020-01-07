<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $auth_user =auth('marketing')->user();
        $company = $auth_user->company;
        $rows =[];
        if ($auth_user->type == 2)
        {
            $rows[] = $auth_user->product;
        }else
        {
            $rows= $company->products;
        }
        return view('pages.marketing.statistics',compact('rows'));
    }

    public function product(Product $product)
    {
        $rows = $product->orders;
       return view('pages.marketing.order',compact('product','rows'));
    }
}
