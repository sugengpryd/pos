<?php

namespace App\Services;

use App\Models\Dbcreated;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CustomerDatabase
{
    public static function connect($userId): void
    {
        $result = Dbcreated::where('users_id', $userId)->firstOrFail();

        Config::set('database.connections.customer_sqlite', [
            'driver' => 'sqlite',
            'database' => $result->path,
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        DB::purge('customer_sqlite');

        DB::connection('customer_sqlite')->getPdo();
    }
}
