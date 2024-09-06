<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VnpaySetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'country_name',
        'currency_name',
        'currency_rate',
        'vnpay_key',
        'vnpay_secret_key'
    ];
}
