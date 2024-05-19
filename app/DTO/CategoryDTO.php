<?php

namespace App\DTO;

use Illuminate\Support\Str;

class CategoryDTO
{
    public string $categoryCode;
    public string $categoryName;

    public function __construct($reqArr)
    {
        $this->categoryCode = $this->generateCode($reqArr->categoryName);
        $this->categoryName = Str::lower($reqArr->categoryName);
    }

    private function generateCode($name) : string
    {
        $prefix = Str::upper(Str::substr($name, 0, 3));
        $code = $prefix . mt_rand(1000, 9999);

        return $code;
    }
}
