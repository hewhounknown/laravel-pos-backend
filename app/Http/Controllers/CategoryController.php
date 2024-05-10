<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function store(Request $req)
    {
        $isExist = $this->findName($req->categoryName);
        if($isExist == true) return "already exist ";

        $categoryCode = $this->generateCode($req->categoryName);

        $category = Category::create([
            'category_code' => $categoryCode,
            'category_name' => $req->categoryName
        ]);

        return $category;
    }

    public function show($id)
    {
        $category = Category::where('id', $id)->first();
        if($category == null){
            return "no data found";
        }
        return $category;
    }

    public function index()
    {
        $categories = Category::all();
        return $categories;
    }

    public function update($id, Request $req)
    {
        $category = $this->show($id);
        if($category == null) return "no data to update";

        //$isExist = $this->findName($req->categoryName);
        //if($isExist == false) return "already exists";

        $categoryCode = $this->generateCode($req->categoryName);

        $result = Category::where('id', $id)->update([
            'category_code' => $categoryCode,
            'category_name' => $req->categoryName
        ]);

        $msg = $result > 0 ? "updated success" : "failed";
        return $msg;
    }

    public function destroy($id)
    {
        $category = $this->show($id);
        if($category == null) return "no data to delete";

        $result = Category::where('id', $id)->delete();

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
        $category = Category::where('category_name', $name)->first();
        if($category == null){
            return false;
        }
        return true;
    }
}
