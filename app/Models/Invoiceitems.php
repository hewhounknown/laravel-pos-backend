<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoiceitems extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'product_id',
        'quantity',
        'unit_price',
        'total_price'
    ];
}
