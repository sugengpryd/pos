<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppn extends Model
{
    protected $table = 'ppn';

    protected $fillable = [
        'batch_id',
        'sellingPrice',
        'ppn',
        'flaq',
    ];

    protected $casts = [
        'sellingPrice' => 'decimal:2',
        'ppn' => 'decimal:2',
        'flaq' => 'boolean',
    ];
}
