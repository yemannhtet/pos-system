<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySlipHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'payslip_image',
        'payment_method',
        'order_code',
        'order_amount'
    ];
}
