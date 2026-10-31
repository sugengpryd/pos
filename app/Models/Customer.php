<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\CustomerDatabase;

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


    static function getCustomer($value,$userId){

        // dd($value);

         CustomerDatabase::connect($userId);

    return self::on('customer_sqlite')
        ->where('id', $value)
        ->value('nama') ?? 'Customer not found';
        $customerName = customer::on('customer_sqlite')->where('id',$value)->first();



        return $customerName->nama ?? '';
    }
}
