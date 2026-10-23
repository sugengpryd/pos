<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class voidtransaksi extends Model
{
    protected $table = 'voidtransaksis';

    protected $fillable = [
        'batch_Id',
        'menu_id',
        'qty',
        'total',
        'flaq',


    ];


}
