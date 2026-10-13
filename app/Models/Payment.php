<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'batch_id',
        'total',
        'discount',
        'pph',
        'grandtotal',
        'nominal',
        'tipe_payment',
        'flaq',
    ];

    protected $casts = [
        'total' => 'decimal:0',
        'discount' => 'decimal:0',
        'pph' => 'decimal:0',
        'grandtotal' => 'decimal:0',
        // 'flaq' => 'boolean',
    ];
}
