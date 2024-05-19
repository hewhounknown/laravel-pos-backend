<?php

namespace App\DTO;

class InvoiceDTO
{
    public string $invoiceNo;
    public string $dateTime;
    public float $subTotal;
    public float $tax;
    public float $discount;
    public float $totalAmount;
    public string $paymentMethod;
    public float $received;
    public float $refund;
    public int $cashierId;

    public function __construct($req)
    {
        $this->invoiceNo = 'INV_' . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        $this->dateTime = date('Y-m-d H:i:s');
        $this->subTotal = 0.00;
        $this->tax = 8.00;
        $this->discount = 0.00;
        $this->totalAmount  = $this->total();
        $this->paymentMethod = $req->payment;
        $this->received = $req->received;
        $this->refund =$this->refund($req->received);
        $this->cashierId = $req->cashierId;
    }

    public function subTotal($price)
    {
        $this->subTotal += $price;
    }

    private function total()
    {
        $tmp = ($this->subTotal + $this->tax) - $this->discount;
        return $tmp;
    }

    private function refund($receive)
    {
        $tmp = $this->totalAmount - $receive;
        return $tmp;
    }


}
