<?php

namespace App\Livewire;
use App\Models\Customer as Customers;
use Livewire\Component;
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




    public function render()
    {
        // $customer= Customers::all()
        $customer = Customers::query()
        ->when($this->filterSearch, function ($query) {
        $query->where('nama', "like", "%" . $this->filterSearch. "%");
        })->get();
        return view('livewire.customer',compact('customer'));
    }
    public function save(){
        // dd("saved");
        if(!$this->editMode){
        //Create
        $addcustomer=Customers::create([
            'nama'=> $this->namaCustomer,
            'Alamat' => $this->alamatCustomer,
            'kota' => $this->pilihKota,
            'telepon1' => $this->telepon1,
            'telepon2' => $this->telepon2,
        ]);
        $this->dispatch('notify', message: 'New Customer has been Saved!');

        }else{
            $updatecustomer= Customers::where('id',$this->customerId)->update([
                'nama'=> $this->namaCustomer,
                'Alamat' => $this->alamatCustomer,
                'kota' => $this->pilihKota,
                'telepon1' => $this->telepon1,
                'telepon2' => $this->telepon2,

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
        // dd($value);
        $this->customerId= $value;
        $editCustomer= Customers::where('id',$value)->first();
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
