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

    public function updateItem($id, $invoiceNo, array $data)
    {
        return Invoiceitems::updateOrInsert(['product_id' => $id, 'invoice_number' => $invoiceNo], $data);
    }

    public function deleteItem($id)
    {
        return Invoiceitems::where('id', $id)->delete();
    }
}
