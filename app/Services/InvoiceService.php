<?php

namespace App\Services;

use App\DTO\InvoiceDTO;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProductRepository;
use App\Repositories\InvoiceItemRepository;

class InvoiceService
{
    protected $invoiceRepo;
    protected $itemRepo;
    protected $productRepo;

    public function __construct(InvoiceRepository $invoRepo, InvoiceItemRepository $itemRepo, ProductRepository $proRepo)
    {
        $this->invoiceRepo = $invoRepo;
        $this->itemRepo = $itemRepo;
        $this->productRepo = $proRepo;
    }

    public function create(InvoiceDTO $dto, array $itemList)
    {
        foreach($itemList as $i)
        {
            $product = $this->productRepo->getById($i->productId);
            if($product->quantity <= $i->qty) return "No enought quantity";

            $this->productRepo->decreaseQty($i->productId, $i->qty);

            $item = $this->toItemArr($i);
            $items[] = $this->itemRepo->createItem($item);
        }

        $arr = $this->toInvoiceArr($dto);
        $invoice = $this->invoiceRepo->createInvoice($arr);

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
        if($isInvoice == null) return "no data to update";

        foreach($itemList as $i)
        {
            $i->invoiceNo = $isInvoice->invoice_number;
            $item = $this->toItemArr($i);
            $items[] = $this->itemRepo->updateItem($i->productId, $i->invoiceNo, $item);
        }

        $dto->invoiceNo = $isInvoice->invoice_number;
        $arr = $this->toInvoiceArr($dto);
        $invoice = $this->invoiceRepo->updateInvoice($id, $arr);

        $response = [$invoice, $items];
        return $response;
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
