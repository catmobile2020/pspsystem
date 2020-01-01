<?php

namespace App\Http\Controllers;

use App\Company;
use App\Helpers\UploadImage;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Program;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    use UploadImage;

    public function index(Request $request)
    {
        $rows = Product::latest()->paginate(20);
        return view('pages.product.index',compact('rows'));
    }

    public function create()
    {
        $product = new Product;
        $programs = Program::all();
        $companies = Company::all();
        return view('pages.product.form',compact('product','programs','companies'));
    }


    public function store(ProductRequest $request)
    {
        $product = Product::create($request->except('photo'));
        if ($request->photo) {
            $this->upload($request->photo,$product);
        }
        return redirect()->route('products.index')->with('message','Done Successfully');
    }

    public function edit(Product $product)
    {
        $programs = Program::all();
        $companies = Company::all();
        return view('pages.product.form',compact('product','programs','companies'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->except('photo','paid_num','free_num'));
        if ($request->photo) {
            $this->upload($request->photo,$product,null,true);
        }
        return redirect()->route('products.index')->with('message','Done Successfully');
    }


    public function destroy(Product $product)
    {
        $product->trash();
        return redirect()->route('products.index')->with('message','Done Successfully');
    }
}
