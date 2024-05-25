<?php

namespace App\DTO;

use App\DTO\InvoiceDTO;

class InvoiceItemDTO
{
    public string $invoiceNo;
    public int $productId;
    public int $qty;
    public float $unitPrice;
    public float $totalPrice;

    public function __construct($item, InvoiceDTO $invoice)
    {
        $this->invoiceNo = $invoice->invoiceNo;
        $this->productId = $item['productId'];
        $this->qty = $item['qty'];
        $this->unitPrice = $item['productPrice'];
        $this->totalPrice = $this->calculateTotal($item['productPrice'], $item['qty']);

        $invoice->subTotal($this->totalPrice);
    }

    private function calculateTotal($price, $qty) : float
    {
        $total = $price * $qty;
        return $total;
    }
}
