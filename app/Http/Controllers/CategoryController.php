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
        $categoryCode = $this->generateCode($req->categoryName);

        $category = category::create([
            'category_code' => $categoryCode,
            'category_name' => $req->categoryName
        ]);

        return $category;
    }

    public function findCategory($id)
    {
        $category = category::where('id', $id)->first();
        if($category == null){
            return "no data found";
        }
        return $category;
    }

    public function getCategories()
    {
        $categories = category::all();
        return $categories;
    }

    public function updateCategory($id, Request $req)
    {
        $category = $this->findCategory($id);
        if($category == null) return "no data to update";

        $categoryCode = $this->generateCode($req->categoryName);

        $result = category::where('id', $id)->update([
            'category_code' => $categoryCode,
            'category_name' => $req->categoryName
        ]);

        $msg = $result > 0 ? "updated success" : "failed";
        return $msg;
    }

    public function deleteCategory($id)
    {
        $category = $this->findCategory($id);
        if($category == null) return "no data to delete";

        $result = category::where('id', $id)->delete();

        $msg = $result > 0 ? "updated success" : "failed";
        return $msg;
    }

    private function generateCode($name)
    {
        $prefix = Str::upper(Str::substr($name, 0, 3));
        $code = $prefix . mt_rand(1000, 9999);

        return $code;
    }


}
