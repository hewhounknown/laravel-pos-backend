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

    public function __construct(string $name, float $price, int $quantity, int $catId)
    {
        $this->productCode = $this->generateCode($name);
        $this->productName = Str::lower($name) ;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->categoryId = $catId;
    }

    private function generateCode($name) : string
    {
        $prefix = Str::upper(Str::substr($name, 0, 3));
        $code = $prefix . mt_rand(1000, 9999);

        return $code;
    }
}
