<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignCustomer extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS = [
        'sent' => 'ارسال شده',
        'received' => 'دریافت شده',
        'failed' => 'ناموفق',
        'unknown' => 'نامشخص',
    ];

    const STATUS_COLOR = [
        'sent' => 'success',
        'received' => 'success',
        'failed' => 'danger',
        'unknown' => 'warning',
    ];
}
