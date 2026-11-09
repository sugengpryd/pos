<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Dbcreated as Dbcreated;
use App\Models\Payment as Dbpayment;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Payment extends Component
{
    public $UsersId = '';
    public $selectPayment=[];
    public $searchFilter='';
    public $dateFilter='';

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

        // $payment= Dbpayment::on('customer_sqlite')->get();
         $payment = Dbpayment::on('customer_sqlite')
        ->when($this->searchFilter, function ($query) {
        $query->where('batch_id', "like", "%" . $this->searchFilter. "%");
    })
        ->when($this->selectPayment, function ($query){
        $query->where('tipe_payment', $this->selectPayment);
    })
        ->when($this->dateFilter, function ($query) {
        $query->where('created_at', "like", "%" . $this->dateFilter. "%");
     }) ->get();

        $tipePayment = Dbpayment::on('customer_sqlite')->select('tipe_payment')->distinct()->get();
        // $createdAt = Dbpayment::on('customer_sqlite')->select('created_at')->distinct()->get();
        $createdAt = Dbpayment::on('customer_sqlite')
            ->selectRaw('DATE(created_at) as date')
            ->distinct()
             ->pluck('date');
        // dd($createdAt);
        // dd($tipePayment);
        // $this->selectPayment = $tipePayment;

        return view('livewire.payment',compact('payment','tipePayment','createdAt'));
    }

    public function updatedSelectPayment(){
    // dd($this->selectPayment);
    }
    public function updatedSearchFilter(){
        // dd($this->searchFilter);
    }
    public function updatedDateFilter(){
        // dd($this->dateFilter);

    }
}
