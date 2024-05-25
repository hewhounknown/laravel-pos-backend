<?php

namespace App\Repositories;

use App\Models\Invoiceitems;

class InvoiceItemRepository
{
    public function getItemss()
    {
       return Invoiceitems::all();
    }

    public function getItem($invoiceNo)
    {
        return Invoiceitems::where('invoice_number', $invoiceNo)->get();
    }

    public function createItem($data)
    {
        return Invoiceitems::create($data);
    }

    public function updateItem($id, array $data)
    {
        return Invoiceitems::where('id', $id)->update($data);
    }

    public function deleteItem($id)
    {
        return Invoiceitems::where('id', $id)->delete();
    }
}
