<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount';

    protected $fillable = [
        'batch_id',
        'sellingPrice',
        'discount',
        'flaq',
    ];

    protected $casts = [
        'sellingPrice' => 'decimal:2',
        'discount' => 'decimal:2',
        'flaq' => 'boolean',
    ];
}
