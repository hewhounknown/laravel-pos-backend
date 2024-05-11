<?php

namespace App\Http\Controllers;

use App\DTO\CategoryDTO;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $catService)
    {
        $this->categoryService = $catService;
    }

    public function store(Request $req)
    {
        $isExist = $this->findName($req->categoryName);
        if($isExist == true) return "already exist ";

        //$categoryCode = $this->generateCode($req->categoryName);

        $dto = new CategoryDTO($req->categoryName);
        $category = $this->categoryService->create($dto);

        return $category;
    }

    public function show($id)
    {
        $category = $this->categoryService->getById($id);
        if($category == null){
            return "no data found";
        }
        return $category;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return $categories;
    }

    public function update($id, Request $req)
    {
        $category = $this->show($id);
        if($category == null) return "no data to update";

        //$isExist = $this->findName($req->categoryName);
        //if($isExist == false) return "already exists";

        //$categoryCode = $this->generateCode($req->categoryName);
        $dto = new CategoryDTO($req->categoryName);
        $result = $this->categoryService->update($id, $dto);

        $msg = $result > 0 ? "updated success" : "failed";
        return $msg;
    }

    public function destroy($id)
    {
        $category = $this->show($id);
        if($category == null) return "no data to delete";

        $result = $this->categoryService->delete($id);

        $msg = $result > 0 ? "deleted success" : "failed";
        return $msg;
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
