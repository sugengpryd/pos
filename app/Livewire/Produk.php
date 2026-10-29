<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use App\Models\Produk as produks;
use App\Models\Dbcreated as Dbcreated;
use App\Models\Uom as Uoms;
use App\Imports\ProductsImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]



class Produk extends Component
{

    // public $produk = [];
    public $filterSearch = '';
    public $filterUom = '';
    public $filterPricing = '';
    public $filterFlaq = '';
    public $showModal ='';
    public $closeShowModal= '';
    public $showDeleteModal ='';
    public $produkId = '';
    public $deleteProduk = '';
    public $produk_uom ='';
    public $harga ='';
    public $description='';
    public $produk_description='';
    public $produk_harga = '';
    public $produk_visibility = '';
    public $flaq='';
    public $UsersId='';
    public $modalImport=false;
    public $file;
    public $message ='';

     use WithFileUploads;

    public function openModalImport(){
    // dd("ModalImport");
    $this->modalImport=true;


    }
    public function closeModalImport(){
    $this->modalImport=false;


    }
    public function importProduk(){

    // dd("import excel");

        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            DB::transaction(function () {
                Excel::import(
                    new ProductsImport(),
                    $this->file->getRealPath()
                );
            });

            $this->message = 'Excel data imported successfully!';

            $this->reset('file');
            $this->dispatch('notify',
                message: $this->message,
                type:'success',
            );

        } catch (\Throwable $e) {
            report($e);

            $this->message = 'Import failed. Please check the Excel columns and database.';
            $this->dispatch('notify',
                message: $this->message,
                type:'error',
            );
        }
    }



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

        $produk = produks::on('customer_sqlite')
        ->when($this->filterSearch, function ($query) {
        $query->where('description', "like", "%" . $this->filterSearch. "%");
    })
        ->when($this->filterUom, function ($query){
        $query->where('uom', $this->filterUom);
    })
        ->when($this->filterPricing, function ($query){
        $query->where('harga', $this->filterPricing);
    })
        ->when($this->filterFlaq != '', function ($query){
        $query->where('flaq', $this->filterFlaq);
    })

        ->get();

        // dd($produk);
        $uom = produks::on('customer_sqlite')->select('uom')->distinct()->get();
        $pricing = produks::on('customer_sqlite')->select('harga')->distinct()->get();
        $master_uom = Uoms::on('customer_sqlite')->get();
        // dd($master_uom);
        // $flaq = produks::select('flaq')->distinct()->get();
        // dd($flaq);

        return view('livewire.produk' ,compact('produk','uom','pricing','master_uom'));
    }

    public function updatedFilterUom($value){
        // dd($value);
        $this->filterUom = $value;
    }
     public function updatedFilterFlaq($value){
        // dd($value);
        // $this->filterFlaq = $value;s
    }

    public function openModal(){
        $this->produkId='';
        $this->resetform();
        $this->showModal = true;

    }
    public function resetform(){
        $this->produk_description = '';
        $this->produk_uom = '';
        $this->produk_harga= '';
        $this->produk_visibility= '';


    }
    public function closeOpenModal(){
        // dd("close Modal");
        $this->showModal = false;
    }
    public function editProduk($value){
        // dd($value);
        $this->createnewConnection();
        $this->produkId = $value;

        // $results= produks::where('id',$value)->first();
        $results= produks::on('customer_sqlite')->findOrFail($value);
        $this->produk_description = $results->description;
        $this->produk_uom = $results->uom;
        $this->produk_harga = number_format($results->harga,
        0,
        ',',
        '.'
        );



        if ($results->flaq != 'true'){
            $flaq = '0';
        }else{
            $flaq = '1';
        }
        // dd($flaq);
        $this->produk_visibility = $flaq;
        $this->showModal= 'true';



    }
    public function save(){
        $this->createnewConnection();
        // dd($this->produkId);
        // $simpan = Product::create([
        //     'description' => $this->produk_description,
        //     'uom' => $this->produk_uom,
        //     'selling_price' => $this->produk_harga,
        //     'flaq' => $this->produk_visibility,
        // ]);
        $harga = (int) str_replace('.', '', $this->produk_harga);

        if ($this->produkId) {

            $produk = produks::on('customer_sqlite')->findOrFail($this->produkId);

        // UPDATE
           $update = $produk->update([
            'description'   => $this->produk_description,
            'uom'           => $this->produk_uom,
            'harga' => $harga,
            'flaq'           => $this->produk_visibility,
            ]);

        } else {
            // dd($harga);
        // CREATE
           $create = produks::on('customer_sqlite')->create([
            'description'   => $this->produk_description,
            'uom'           => $this->produk_uom,
            'harga' => $harga,
            'flaq'           => $this->produk_visibility,
        ]);
        }

    $this->showModal = false;
    }
}



