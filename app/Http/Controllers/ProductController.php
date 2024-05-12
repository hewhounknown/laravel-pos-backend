<?php

namespace App\Http\Controllers;

use App\DTO\ProductDTO;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getAll();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $dto = new ProductDTO($req->productName, $req->price, $req->quantity, $req->categoryId);
        $product = $this->productService->create($dto);
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->productService->getById($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $req)
    {
        $dto = new ProductDTO($req->productName, $req->price, $req->quantity, $req->categoryId);
        $product = $this->productService->update($id, $dto);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = $this->productService->delete($id);
        return response()->json($product);
    }
}
