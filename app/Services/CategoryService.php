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
        $isExist = $this->categoryRepo->findName($catDTO->categoryName);
        if($isExist != null) return "already exist";

        $data = $this->toArr($catDTO);
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
        $isExist = $this->categoryRepo->getById($id);
        if($isExist == null) return 0;

        if($isExist->category_name == $catDTO->categoryName){
            $catDTO->categoryCode = $isExist->category_code;
        }

        $data = $this->toArr($catDTO);
        $category = $this->categoryRepo->update($id, $data);
        return $category;
    }

    public function delete($id)
    {
        $isExist = $this->categoryRepo->getById($id);
        if($isExist == null) return 0;

        $category = $this->categoryRepo->delete($id);
        return $category;
    }

    private function toArr(CategoryDTO $catDTO)
    {
        $arr = [
            'category_code' => $catDTO->categoryCode,
            'category_name' => $catDTO->categoryName
        ];
        return $arr;
    }
}
