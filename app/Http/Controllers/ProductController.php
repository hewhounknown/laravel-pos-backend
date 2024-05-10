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
        $products = Product::all();
        return $products;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $isExist = $this->findName($req->productName);
        if($isExist == true) return "already exist";

        $productCode = $this->generateCode($req->productName);

        $product = Product::create([
            'product_code' => $productCode,
            'product_name' => $req->productName,
            'price' => $req->productPrice,
            'quantity' => $req->productQuantity,
            'category_id' => $req->categoryId
        ]);

        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $req)
    {
        $product = $this->show($id);
        if($product == null) return "no data to update";

        //$isExist = $this->findName($req->productName);
        //if($isExist == true) return "already exist";

        $productCode = $this->generateCode($req->productName);

        $result = Product::where('id', $id)->update([
            "product_code" => $productCode,
            "product_name" => $req->productName,
            "price" => $req->productPrice,
            "quantity" => $req->productQuantity,
            "category_id" => $req->categoryId
        ]);

        $msg = $result > 0 ? "updated success" : "failed";
        return $msg;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = $this->show($id);
        if($product == null) return "no data to delete";

        $result = $product->delete();

        $msg = $result > 0 ? "deleted success" : "failed";
        return $msg;
    }

    private function generateCode($name)
    {
        $prefix = Str::upper(Str::substr($name, 0, 3));
        $code = $prefix . mt_rand(1000, 9999);

        return $code;
    }

    private function findName($name)
    {
        $product = Product::where('product_name', $name)->first();
        if($product == null){
            return false;
        }
        return true;
    }
}
