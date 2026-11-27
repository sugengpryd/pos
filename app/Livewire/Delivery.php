<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\pengiriman as DbPengiriman;
use App\Models\Dbcreated as Dbcreated;
use App\Models\Customer as Dbcustomer;
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

    //     $result = DbPengiriman::on('customer_sqlite')
    //     ->when($this->filterSearch, function ($query) {
    //     $query->where(function ($q) {
    //         $search = '%' . $this->filterSearch . '%';

    //         $q->where('batch_Id', 'like', $search)
    //             ->orWhere('fromName', 'like', $search)
    //             ->orWhere('fromAlamat', 'like', $search)
    //             ->orWhere('toName', 'like', $search)
    //             ->orWhere('toAlamat', 'like', $search)
    //             ->orWhere('toNumber', 'like', $search);
    //     });
    // })
    // ->when($this->filterDate, function ($query) {
    //     $query->whereDate('created_at', $this->filterDate);
    // })
    // ->latest('created_at')
    // ->get();
    $result = DbPengiriman::on('customer_sqlite')
    ->leftjoin('transaksi', 'pengiriman.batch_Id', '=', 'transaksi.batch_id')
    ->select('pengiriman.*', 'transaksi.customer_Id')
    ->distinct()
    ->when($this->filterSearch, function ($query) {
        $query->where(function ($q) {
            $search = '%' . $this->filterSearch . '%';

            $q->where('pengiriman.batch_Id', 'like', $search)
                ->orWhere('pengiriman.fromName', 'like', $search)
                ->orWhere('pengiriman.fromAlamat', 'like', $search)
                ->orWhere('pengiriman.toName', 'like', $search)
                ->orWhere('pengiriman.toAlamat', 'like', $search)
                ->orWhere('pengiriman.toNumber', 'like', $search);
        });
    })
    ->when($this->filterDate, function ($query) {
        $query->whereDate('pengiriman.created_at', $this->filterDate);
    })
    ->latest('pengiriman.created_at')
    ->get();

    // dd($result);

    // $biayakirim =$result->sum('BiayaKirim')
        $biayakirim = $result->where('batch_Id', '!=','')
                             ->where('flaq', '==', '1')
                             ->sum('BiayaKirim');



    // dd($biayakirim);

        return view('livewire.delivery',compact('result','biayakirim'));
    }
}
