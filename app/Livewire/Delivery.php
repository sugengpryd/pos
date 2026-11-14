<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\pengiriman as DbPengiriman;
use App\Models\Dbcreated as Dbcreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]


#Layout(["layouts.app"])

class Delivery extends Component
{
    public $showModal=false;
    public $modalOpen='';
    public $editMode='';
    public $customerId = '';
    public $namaCustomer='';
    public $alamatCustomer='';
    public $pilihKota='';
    public $telepon1='';
    public $telepon2='';
    public $filterSearch='';
    public $filterDate='';
    public $dateSelect='';
    public $UsersId='';
    public $flaq = [];

    public function mount()
    {
    $this->UsersId = Auth::id();
    $this->createnewConnection();
    }

    public function filterDatefunction(){
        // dd($this->filterDate);


    }
    public function createnewConnection(){
    // dd($this->UsersId);
        $this->dbconnection = 'customer_sqlite';
        $result = Dbcreated::where('users_id', $this->UsersId)->first();
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

    public function render()
    {
        $this->createnewConnection();

        $result = DbPengiriman::on('customer_sqlite')
        ->when($this->filterSearch, function($query){
            $query->where('batch_id', 'like', '%' . $this->filterSearch .'%')
            ->orwhere('fromName', 'like', '%' . $this->filterSearch .'%')
            ->orwhere('fromAlamat', 'like', '%' . $this->filterSearch .'%')
            ->orwhere('toName', 'like', '%' . $this->filterSearch .'%')
            ->orwhere('toNumber', 'like', '%' . $this->filterSearch .'%');
            })
        ->when($this->filterDate,function($query){
        $query->where('created_at', 'like', '%' . $this->filterDate .'%');
        })
        ->get();

        return view('livewire.delivery',compact('result'));
    }
}
