<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'description',
        'uom',
        'harga',
        'flaq',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'flaq' => 'boolean',
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'produk_id');
    }
    static function getprodukName($value){
        $produkname= Produk::where('id',$value)->first() ;
        // dd($produkname->description);
        return $produkname->description ?? '';

    }
}
