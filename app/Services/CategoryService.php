<?php

namespace App\Services;

use App\DTO\CategoryDTO;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $catRepo)
    {
        $this->categoryRepo = $catRepo;
    }

    public function create(CategoryDTO $catDTO)
    {
        $data = [
            'category_code' => $catDTO->categoryCode,
            'category_name' => $catDTO->categoryName
        ];
        $category = $this->categoryRepo->create($data);
        return $category;
    }

    public function getById($id)
    {
        $category = $this->categoryRepo->getById($id);
        return $category;
    }

    public function getAll()
    {
        $list = $this->categoryRepo->getAll();
        return $list;
    }

    public function update($id, CategoryDTO $catDTO)
    {
        $data = [
            'category_code' => $catDTO->categoryCode,
            'category_name' => $catDTO->categoryName
        ];
        $category = $this->categoryRepo->update($id, $data);
        return $category;
    }

    public function delete($id)
    {
       $cat = $this->categoryRepo->delete($id);
       return $cat;
    }
}
