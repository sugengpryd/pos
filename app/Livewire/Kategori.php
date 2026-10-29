<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\kategori as kategories;
use App\Models\Dbcreated as Dbcreated;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;


#[Layout('layouts.app')]

class Kategori extends Component
{
     use WithFileUploads;


    public $showModal='';
    public $editMode=false;
    public $kategoriId = '';
    public $kategoriDescription='';
    public $kategoriFlaq='';
    public $filterSearch='';
    public $filterFlaq = '';
    public $kategori_image='';
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

        // $kategories = kategories::where('flaq','1')->get();
        // $kategories = kategories::all();
        $this->createnewConnection();
        $kategories = kategories::on('customer_sqlite')
            ->when($this->filterSearch, function ($query) {
                $query->where('description', 'like', '%' . $this->filterSearch . '%');
            })
            ->when($this->filterFlaq!=='', function($query){
                $query->where('flaq',$this->filterFlaq);
            })
            ->get();
        // dd($kategories);
        return view('livewire.kategori',compact('kategories'));
    }
    public function openModal(){
        // dd('Open Modal');
        $this->showModal=true;
    }
    public function closeopenModal(){
        $this->showModal=false;
        $this->editMode=false;
        $this->kategoriId = null;
        $this->kategoriDescription = '';
        $this->kategoriFlaq = "";
        $this->editMode = false;


    }

    public function upload_image($kategori_id){
        $this->createnewConnection();
            // dd($produk_id);
            // $produkId =
        $this->validate([
            'kategori_image' => 'required|file|max:20480',
        ]);

        $path=$this->kategori_image->store('image', 'public');

        // $get = Menus::where('menu_id',$produk_id)->first();
        $updateMenu=kategories::on('customer_sqlite')->where('id',$kategori_id)->update([
            'image' => $path,
        ]);
        // dd($get);


        // session()->flash('success', 'File berhasil diupload.');
        $this->dispatch('notify', message: 'Image upload success');


        $this->reset('kategori_image');

    }

    public function save(){
        $this->createnewConnection();

    //  dd([
    //     'kategoriId' => $this->kategoriId,
    //     'editMode' => $this->editMode,
    //     'description' => $this->kategoriDescription,
    //     'flaq' => $this->kategoriFlaq,
    // ]);

        $find = kategories::on('customer_sqlite')->where('id',$this->kategoriId)->first();
        // dd($find);
        // if($this->editMode){
            if($find){

            $update= kategories::on('customer_sqlite')->where('id',$this->kategoriId)->update([
                'description'=> $this->kategoriDescription,
                'flaq'=> $this->kategoriFlaq,



            ]);

            }else{
                // dd($find);

                $create= kategories::on('customer_sqlite')->create([
                    'description'=> $this->kategoriDescription,
                    'flaq'=> $this->kategoriFlaq,


                ]);
            }
        $this->upload_image($this->kategoriId);
        $this->closeopenModal();


    }
    public function editKategori($value){
        $this->createnewConnection();
        $this->kategoriId = $value;

        $editkategori= kategories::on('customer_sqlite')->where('id',$value)->first();

        $this->kategoriDescription= $editkategori->description;
        $this->kategoriFlaq= $editkategori->flaq;

        $this->editMode=true;
        $this->showModal=true;


    }
    public function deleteKategori($value){
        $deleteKategori = kategories::on('customer_sqlite')->where('id',$value)->delete();
    }
}
