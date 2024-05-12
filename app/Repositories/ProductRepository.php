<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        return Product::all();
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        return Product::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Product::where('id', $id)->delete();
    }

    public function findName($name)
    {
        return Product::where('product_name', $name)->first();
    }
}
