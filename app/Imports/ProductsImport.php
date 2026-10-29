<?php

namespace App\Imports;

use App\Models\Produk;
use App\Models\Dbcreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $UsersId='';

    public function mount()
    {
    $this->UsersId = Auth::id();
    $this->createnewConnection();
    }

    public function createnewConnection(){
    // dd(Auth::id());
        $this->dbconnection = 'customer_sqlite';
        $result = Dbcreated::where('users_id', Auth::id())->first();
        // dd($result);
        $path = $result->path;
        $dbname = $result->db_name;
            // Register connection dynamically
        Config::set('database.connections.customer_sqlite', [
        'driver' => 'sqlite',
        'database' => $path,
        'prefix' => '',
        'foreign_key_constraints' => true,
        ]);
        // Connect to the new database
        DB::purge('customer_sqlite');
        DB::connection('customer_sqlite')->getPdo();
    }


    public function model(array $row)
    {
        $this->createnewConnection();
        return (new Produk())->setConnection('customer_sqlite')
            ->fill([
                'description' => trim($row['description'] ?? ''),
                'uom'         => trim($row['uom'] ?? ''),
                'harga'       => $row['harga'] ?? 0,
                'flaq'        => $row['flaq'] ?? 1,
            ]);
    }
}
