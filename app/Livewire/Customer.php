<?php

namespace App\Livewire;
use App\Models\Customer as Customers;
use App\Models\Dbcreated as Dbcreated;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class Customer extends Component
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
    public $UsersId='';
    public $flaq = [];

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
        // $customer= Customers::all()
        $customer = Customers::on('customer_sqlite')
        ->when($this->filterSearch, function ($query) {
        $query->where('nama', "like", "%" . $this->filterSearch. "%");
        })->get();
        return view('livewire.customer',compact('customer'));
    }
    public function save(){

    // dd($this->flaq);
        $this->createnewConnection();
        // dd("saved");
        if(!$this->editMode){
        //Create
        $addcustomer=Customers::on('customer_sqlite')->create([
            'nama'=> $this->namaCustomer,
            'Alamat' => $this->alamatCustomer,
            'kota' => $this->pilihKota,
            'telepon1' => $this->telepon1,
            'telepon2' => $this->telepon2,
            'flaq' => $this->flaq,
        ]);
        $this->dispatch('notify', message: 'New Customer has been Saved!');

        }else{
            $updatecustomer= Customers::on('customer_sqlite')->where('id',$this->customerId)->update([
                'nama'=> $this->namaCustomer,
                'Alamat' => $this->alamatCustomer,
                'kota' => $this->pilihKota,
                'telepon1' => $this->telepon1,
                'telepon2' => $this->telepon2,
                'flaq' => $this->flaq,


            ]);
        $this->dispatch('notify', message: 'Customer Updated!');

        }
        // $this->showModal=false;
        $this->closeOpenModal();
    }
    public function openModal(){
        // dd('show');
        $this->showModal=true;

    }
    public function closeOpenModal(){

        $this->namaCustomer='';
        $this->alamatCustomer='';
        $this->pilihKota='';
        $this->telepon1='';
        $this->telepon2='';

        $this->showModal=false;
        $this->editMode = false;
        $this->addMode = false;
    }
    public function selectKota(){

    }
    public function editCustomer($value){
        $this->createnewConnection();
        // dd($value);
        $this->customerId= $value;
        $editCustomer= Customers::on('customer_sqlite')->where('id',$value)->first();
        // dd($editCustomer);
        $this->namaCustomer=$editCustomer->nama;
        $this->alamatCustomer=$editCustomer->Alamat;
        $this->pilihKota=$editCustomer->kota;
        $this->telepon1=$editCustomer->telepon1;
        $this->telepon2=$editCustomer->telepon2;

        $this->editMode =true;
        $this->showModal=true;

    }
}
