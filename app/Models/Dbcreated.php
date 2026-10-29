<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dbcreated extends Model
{
    protected $table = 'dbcreateds';

    protected $fillable = [
        'users_id',
        'db_name',
        'flaq',
        'size',
        'path',


    ];

    public function user(): BelongsTo
    {
        // return $this->belongsTo(Menu::class, 'menu_id');
     return $this->belongsTo(
        User::class,
        'id',   // FK in transaksi
        'users_id'    // key in menu
         );
    }


}
