<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\kategori as kategories;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class Kategori extends Component
{
    public $showModal='';
    public $editMode=false;
    public $kategoriId = '';
    public $kategoriDescription='';
    public $kategoriFlaq='';
    public $filterSearch='';
    public $filterFlaq = '';

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
