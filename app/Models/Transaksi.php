<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'batch_id',
        'menu_id',
        'qty',
        'sellingPrice',
        'total',
        'customer_Id',
        'flaq',
    ];

    protected $casts = [
        'qty' => 'decimal:0',
        'sellingPrice' => 'decimal:0',
        'total' => 'decimal:0',
        'flaq' => 'string',
    ];

    public function menu(): BelongsTo
    {
        // return $this->belongsTo(Menu::class, 'menu_id');
     return $this->belongsTo(
        Menu::class,
        'menu_id',   // FK in transaksi
        'menu_id'    // key in menu
         );
    }
    static function basket($value){
        // dd($value);
        $result = Transaksi::where('flaq','basket')->where('customer_Id',$value)->count();
        // dd($result);
        return $result;

    }
}
