<?php

namespace App\Livewire;
use App\Models\Produk as produks;
use App\Models\Uom as Uoms;
use Livewire\Component;
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





    public function render()
    {
        $produk = produks::query()
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
        $uom = produks::select('uom')->distinct()->get();
        $pricing = produks::select('harga')->distinct()->get();
        $master_uom = Uoms::all();
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
        $this->produkId = $value;

        // $results= produks::where('id',$value)->first();
        $results= produks::findOrFail($value);
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
        // dd($this->produkId);
        // $simpan = Product::create([
        //     'description' => $this->produk_description,
        //     'uom' => $this->produk_uom,
        //     'selling_price' => $this->produk_harga,
        //     'flaq' => $this->produk_visibility,
        // ]);
        $harga = (int) str_replace('.', '', $this->produk_harga);

        if ($this->produkId) {

            $produk = produks::findOrFail($this->produkId);

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
           $create = produks::create([
            'description'   => $this->produk_description,
            'uom'           => $this->produk_uom,
            'harga' => $harga,
            'flaq'           => $this->produk_visibility,
        ]);
        }

    $this->showModal = false;
    }
}



