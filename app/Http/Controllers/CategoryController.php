<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function createCategory(Request $req)
    {
        $prefix = Str::upper(Str::substr($req->categoryName, 0, 3));
        $categoryCode = $prefix . mt_rand(1000, 9999);

        $category = category::create([
            'category_code' => $categoryCode,
            'category_name' => $req->categoryName
        ]);

        return $category;
    }
}
