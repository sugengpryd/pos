<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Attributes\Layout;
#[Layout('Layouts.app')]

class Menu_item extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'menu_id',
        'produk_id',
        'description',
        'qty',
        'harga',
        'uom',
        'flaq',

    ];

    protected $casts = [
        // 'sellingPrice' => 'decimal:2',
        'flaq' => 'boolean',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'menu_id');
    }
}
