<?php

namespace App\Repositories;

use App\Models\Invoice;

class InvoiceRepository
{
    public function getInvoices()
    {
       return Invoice::all();
    }

    public function getInvoice($id)
    {
        return Invoice::where('id', $id)->first();
    }

    public function createInvoice(array $data)
    {
        return Invoice::create($data);
    }

    public function updateInvoice($id, array $data)
    {
        return Invoice::where('id', $id)->update($data);
    }

    public function deleteInvoice($id)
    {
        return Invoice::where('id', $id)->delete();
    }
}
