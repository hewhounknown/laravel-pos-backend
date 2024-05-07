<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function createProduct(Request $req)
    {
        $prefix = Str::upper(Str::limit($req->categoryName, 3));
        return $prefix;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prefix = Str::upper(Str::limit($request->categoryName, 3));
        return $prefix;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
