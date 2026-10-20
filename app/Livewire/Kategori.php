<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\kategori as kategories;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;


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

    public function render()
    {
        // $kategories = kategories::where('flaq','1')->get();
        // $kategories = kategories::all();
        $kategories = kategories::query()
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
        // dd('Open Modal');
        $this->editMode=false;
        $this->kategoriId = null;
        $this->kategoriDescription = '';
        $this->kategoriFlaq = "";
        $this->editMode = false;
        $this->showModal=false;


    }

    public function upload_image($kategori_id){

            // dd($produk_id);
            // $produkId =
        $this->validate([
            'kategori_image' => 'required|file|max:20480',
        ]);

        $path=$this->kategori_image->store('image', 'public');

        // $get = Menus::where('menu_id',$produk_id)->first();
        $updateMenu=kategories::where('id',$kategori_id)->update([
            'image' => $path,
        ]);
        // dd($get);


        // session()->flash('success', 'File berhasil diupload.');
        $this->dispatch('notify', message: 'Image upload success');


        $this->reset('kategori_image');

    }

    public function save(){

    //  dd([
    //     'kategoriId' => $this->kategoriId,
    //     'editMode' => $this->editMode,
    //     'description' => $this->kategoriDescription,
    //     'flaq' => $this->kategoriFlaq,
    // ]);

        $find = kategories::where('id',$this->kategoriId)->first();
        // dd($find);
        // if($this->editMode){
            if($find){

            $update= kategories::where('id',$this->kategoriId)->update([
                'description'=> $this->kategoriDescription,
                'flaq'=> $this->kategoriFlaq,



            ]);

            }else{
                // dd($find);

                $create= kategories::create([
                    'description'=> $this->kategoriDescription,
                    'flaq'=> $this->kategoriFlaq,


                ]);
            }
        $this->upload_image($this->kategoriId);
        $this->closeopenModal();


    }
    public function editKategori($value){
        $this->kategoriId = $value;

        $editkategori= kategories::where('id',$value)->first();

        $this->kategoriDescription= $editkategori->description;
        $this->kategoriFlaq= $editkategori->flaq;

        $this->editMode=true;
        $this->showModal=true;


    }
    public function deleteKategori($value){
        $deleteKategori = kategories::where('id',$value)->delete();
    }
}
