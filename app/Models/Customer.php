<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
        'nama',
        'Alamat',
        'kota',
        'telepon1',
        'telepon2',
    ];

    static function getCustomer($value){

        // dd($value);
        $customerName = customer::on('customer_sqlite')->where('id',$value)->first();


        return $customerName->nama ?? '';
    }
}
