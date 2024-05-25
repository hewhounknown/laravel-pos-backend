<?php

namespace App\Services;

use App\DTO\ProductDTO;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function create(ProductDTO $dto)
    {
        $isExist = $this->productRepo->findName($dto->productName);
        if($isExist != null) return "already exist";

        $data = $this->toArr($dto);
        $product = $this->productRepo->create($data);

        return $product;
    }

    public function getById($id)
    {
        $product = $this->productRepo->getById($id);
        return $product;
    }

    public function getAll()
    {
        $list = $this->productRepo->getAll();
        return $list;
    }

    public function update($id, ProductDTo $dto)
    {
        $isExist = $this->productRepo->getById($id);
        if($isExist == null) return "no data to update";

        if($isExist->product_name == $dto->productName){
            $dto->productCode = $isExist->product_code;
        }

        $data = $this->toArr($dto);
        $product = $this->productRepo->update($id, $data);

        return $product;
    }

    public function delete($id)
    {
        $isExist = $this->productRepo->getById($id);
        if($isExist == null) return "no data to delete";

        $product = $this->productRepo->delete($id);
        return $product;
    }

    private function toArr(ProductDTO $dto)
    {
        $arr = [
            'product_code' => $dto->productCode,
            'product_name' => $dto->productName,
            'price' => $dto->price,
            'quantity' => $dto->qty,
            'category_id' => $dto->categoryId
        ];

        return $arr;
    }
}
