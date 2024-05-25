<?php

namespace App\Http\Controllers;

use App\DTO\InvoiceDTO;
use App\DTO\InvoiceItemDTO;
use Illuminate\Http\Request;
use App\Services\InvoiceService;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $service)
    {
        $this->invoiceService = $service;
    }

    public function index()
    {
        $invoices = $this->invoiceService->getAll();
        return response()->json($invoices, 200);
    }

    public function store(Request $req)
    {
        $dtoInvoice = new InvoiceDTO($req);

        foreach($req->item as $item){
            $itemdto = new InvoiceItemDTO($item, $dtoInvoice);
            $list[] = $itemdto;
        }

        $invoice = $this->invoiceService->create($dtoInvoice, $list);
        return response()->json($invoice, 200);
    }

    public function show($id)
    {
        $invoice = $this->invoiceService->get($id);
        return response()->json($invoice, 200);
    }

    public function update($id, Request $req)
    {
        //
    }

    public function destroy($id)
    {
        $invoice = $this->invoiceService->delete($id);
        return response()->json($invoice, 200);
    }
}
