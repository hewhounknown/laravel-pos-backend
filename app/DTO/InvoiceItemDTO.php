<?php

namespace App\DTO;

use App\DTO\InvoiceDTO;

class InvoiceItemDTO
{
    public string $invoiceNo;
    public int $productId;
    public int $quantity;
    public float $unitPrice;
    public float $totalPrice;

    public function __construct($item, InvoiceDTO $invoice)
    {
        $this->invoiceNo = $invoice->invoiceNo;
        $this->productId = $item['productId'];
        $this->quantity = $item['quantity'];
        $this->unitPrice = $item['productPrice'];
        $this->totalPrice = $this->calculateTotal($item['productPrice'], $item['quantity']);

        $invoice->subTotal($this->totalPrice);
    }

    private function calculateTotal($price, $quantity) : float
    {
        $total = $price * $quantity;
        return $total;
    }
}
