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

    static function get_pengiriman($batchId){
        // dd($batchId);
    $pengiriman = pengiriman::on('customer_sqlite')->where('batch_Id',$batchId)->value('BiayaKirim');

    // dd($pengiriman);
    return $pengiriman;
    }

}
