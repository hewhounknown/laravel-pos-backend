<?php

namespace App\Http\Controllers;

use App\DTO\CategoryDTO;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
    }

    public function store(Request $req)
    {
        $dto = new CategoryDTO($req);
        $category = $this->categoryService->create($dto);

        return response()->json($category);
    }

    public function show($id)
    {
        $category = $this->categoryService->getById($id);
        return response()->json($category);
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return response()->json($categories);;
    }

    public function update($id, Request $req)
    {
        $dto = new CategoryDTO($req);
        $category = $this->categoryService->update($id, $dto);

        return $this->response($category, "updated");

    }

    public function destroy($id)
    {
        $category = $this->categoryService->delete($id);
        return $this->response($category, "deleted");
    }

    private function response($condition, $action)
    {
        if($condition == true){
            return response()->json([
                'status' => true,
                'message' => $action . ' success'
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'message' => 'no data found'
            ], 404);
        }
    }

}
