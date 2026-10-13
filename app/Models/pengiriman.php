<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengiriman extends Model
{
    protected $table = 'pengiriman';

    protected $fillable = [
    'batch_Id',
    'fromName',
    'fromAlamat',
    'toName',
    'toAlamat',
    'toNumber',
    'BiayaKirim',
    'flaq',
    ];

}
