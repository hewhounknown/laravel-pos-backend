<?php

namespace App\DTO;

use Illuminate\Support\Str;

class ProductDTO
{
    public string $productCode;
    public string $productName;
    public float $price;
    public int $quantity;
    public int $categoryId;

    public function __construct($req)
    {
        $this->productCode = $this->generateCode($req->productName);
        $this->productName = Str::lower($req->productName) ;
        $this->price = $req->price;
        $this->quantity = $req->quantity;
        $this->categoryId = $req->categoryId;
    }

    private function generateCode($name) : string
    {
        $prefix = Str::upper(Str::substr($name, 0, 3));
        $code = $prefix . mt_rand(1000, 9999);

        return $code;
    }
}
