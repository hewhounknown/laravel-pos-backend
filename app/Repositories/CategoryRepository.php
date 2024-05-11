<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }

    public function getById($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        return Category::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Category::where('id', $id)->delete();
    }
}
