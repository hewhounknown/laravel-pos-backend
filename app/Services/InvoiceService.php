<?php

namespace App\Services;

use App\DTO\InvoiceDTO;
use App\Repositories\InvoiceRepository;
use App\Repositories\InvoiceItemRepository;

class InvoiceService
{
    protected $invoiceRepo;
    protected $itemRepo;

    public function __construct(InvoiceRepository $invoRepo, InvoiceItemRepository $itemRepo)
    {
        $this->invoiceRepo = $invoRepo;
        $this->itemRepo = $itemRepo;
    }

    public function create(InvoiceDTO $dto, array $itemList)
    {
        $arr = $this->toInvoiceArr($dto);
        $invoice = $this->invoiceRepo->createInvoice($arr);

        foreach($itemList as $i)
        {
            $item = $this->toItemArr($i);
            $items[] = $this->itemRepo->createItem($item);
        }

        $response = [$invoice, $items];
        return $response;
    }

    public function get($id)
    {
        $invoice = $this->invoiceRepo->getInvoice($id);
        $items = $this->itemRepo->getItem($invoice->invoice_number);

        $response = [$invoice, $items];
        return $response;
    }

    public function getAll()
    {
        $invoices = $this->invoiceRepo->getInvoices();
        return $invoices;
    }

    public function update($id, InvoiceDTO $dto, array $itemList)
    {
        $isInvoice = $this->invoiceRepo->getInvoice($id);
    }

    public function delete($id)
    {
        $isInvoice = $this->invoiceRepo->getInvoice($id);
        if($isInvoice == null) return "no data to delete";

        $items = $this->itemRepo->getItem($isInvoice->invoice_number);

        foreach($items as $item)
        {
            $this->itemRepo->deleteItem($item->id);
        }

        $invoice = $this->invoiceRepo->deleteInvoice($id);
        return $invoice;
    }

    private function toInvoiceArr(InvoiceDTO $dto) : array
    {
       $arr = [
        'invoice_number' => $dto->invoiceNo,
        'invoice_date_time' => $dto->dateTime,
        'sub_total' => $dto->subTotal,
        'tax' => $dto->tax,
        'discount' => $dto->discount,
        'total_amount' => $dto->totalAmount,
        'payment_method' => $dto->paymentMethod,
        'received_amount' => $dto->received,
        'refunded_amount' => $dto->refund,
        'user_id' => $dto->cashierId
       ];

       return $arr;
    }

    private function toItemArr($dto) : array
    {
        $arr = [
            'invoice_number' => $dto->invoiceNo,
            'product_id' => $dto->productId,
            'quantity' => $dto->qty,
            'unit_price' => $dto->unitPrice,
            'total_price' => $dto->totalPrice
        ];

        return $arr;
    }
}
