<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi as Transaksis;
use App\Models\Dbcreated as Dbcreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class Transaksi extends Component

{
    public $FilterBatchId = '';
    public $FilterMenu = '';
    public $FilterCustomer = '';
    public $FilterStatus = '';
    public $FilterDate = '';
    public $UsersId='';



    public function mount()
    {
    $this->UsersId = Auth::id();
    $this->createnewConnection();
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
        // $batchId = Transaksis::select('batch_id')->distinct()->get();
        $batchId = Transaksis::on('customer_sqlite')->distinct()->pluck('batch_id');
        $menuId = Transaksis::on('customer_sqlite')->distinct()->pluck('menu_id');
        $customerId = Transaksis::on('customer_sqlite')->distinct()->pluck('customer_Id');
        $status = Transaksis::on('customer_sqlite')->distinct()->pluck('flaq');
        // $created_at = Transaksis::distinct()->pluck('created_at');
        $created_at = Transaksis::on('customer_sqlite')
            ->selectRaw('DATE(created_at) as created_date')
            ->distinct()
            ->pluck('created_date');
        // dd($created_at);

        // dd($batchId);

        $transaksi= Transaksis::on('customer_sqlite')
        ->when($this->FilterBatchId, function ($query) {
            $query->where('batch_id','like', "%" . $this->FilterBatchId. "%");

        })
        ->when($this->FilterMenu, function ($query) {
            $query->where('menu_id','like', "%" . $this->FilterMenu. "%");

        })
        ->when($this->FilterCustomer, function ($query) {
            $query->where('customer_Id', "=" , $this->FilterCustomer);

        })
        ->when($this->FilterStatus, function ($query) {
            $query->where('flaq', "=" , $this->FilterStatus);

        })
        ->when($this->FilterDate, function ($query) {
            // $query->where('created_at', "like" , "%" . $this->FilterDate . "%");
            $query->whereDate('created_at', $this->FilterDate );

        })
        ->get();
        // dd($this->FilterDate);

        // $total = $transaksi->where('batch_id', '!=','')->where('flaq','paid')->sum('total');
        $total = $transaksi->where('batch_id', '!=','')->sum('total');
        // $total = $transaksi->sum('total');
        $qty = $transaksi->sum('qty');

        return view('livewire.transaksi',compact('transaksi','batchId','menuId','customerId','total','qty','status','created_at'));
    }

    public function updatedFilterDate(){
        // dd($this->FilterDate);

        // $result= Transaksis::whereDate('created_at', "like", "%" . $this->FilterDate)->get();
        // dd($result);

    }
}
