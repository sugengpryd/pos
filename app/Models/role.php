<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'role';

    protected $fillable = [
    'user_id',
    'role',
    'flaq',


    ];

    protected $casts = [

    ];

}
