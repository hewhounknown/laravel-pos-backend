<?php

namespace App\Http\Controllers;

use App\DTO\InvoiceDTO;
use App\DTO\InvoiceItemDTO;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function index()
    {
        //
    }

    public function store(Request $req)
    {
        $dtoInvoice = new InvoiceDTO($req);

        foreach($req->item as $item){
            $itemdto = new InvoiceItemDTO($item, $dtoInvoice);
            $list[] = $itemdto;
        }
        $resp = [$dtoInvoice, $list];
        return $resp;
    }

    public function show($id)
    {
        //
    }

    public function update($id, Request $req)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
