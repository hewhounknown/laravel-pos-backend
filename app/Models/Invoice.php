<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'invoice_date_time',
        'sub_total',
        'tax',
        'discount',
        'total_amount',
        'payment_method',
        'received_amount',
        'refunded_amount',
        'user_id'
    ];
}
