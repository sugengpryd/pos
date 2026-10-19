<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Attributes\Layout;
#[Layout('Layouts.app')]

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        // 'produk_id',
        'menu_id',
        'description',
        'kategori',
        'item_qty',
        'uom',
        'sellingPrice',
        'image',
        'flaq',
    ];

    protected $casts = [
        'sellingPrice' => 'decimal:2',
        'flaq' => 'boolean',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function transaksis(): HasMany
    {
        // return $this->hasMany(Transaksi::class, 'menu_id');
        return $this->hasMany(
            Transaksi::class,
            'menu_id',
            'menu_id'
        );
    }
    static function get_name($value){
        // dd($value);

        $name = menu::select('menu_id','description')->where('menu_id','=',$value)->pluck('description');
        // $name = menu::all();

        return $name[0];

    }
}
