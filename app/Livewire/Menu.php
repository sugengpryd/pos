<?php

namespace App\Livewire;

use App\Models\Menu as Menus;
use App\Models\Produk as Produk;
use App\Models\Menu_item as menu_item;
use App\Models\Uom as Uoms;
use App\Models\kategori as kategoris;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]

class Menu extends Component
{
     use WithFileUploads;

    public $showModal='';
    public $menuId= '';
    public $menu_description='';
    public $menu_uom ='';
    public $menu_qty ='';
    public $menu_harga ='';
    public $menu_visibility ='1';
    public $menu_kategori='';
    public $description='';
    public $uom='';
    public $harga='';
    public $visibility='';
    public $itemQty=[];
    public $produk_id=[];
    // public $changeitemQty='';
    public $editMode=false;
    public $addMode=false;

    public $selectProduk;
    public $items=[];
    public $menu_image;




    public function render()
    {
        $menu= Menus::all();
        $produk= Produk::where('flaq','!=','0')->get();
        $master_uom = Uoms::all();
        $kategori = kategoris::all();
        // dd($menu);

        return view('livewire.menu',compact('menu','produk','master_uom','kategori'));
    }
    public function openModal(){
        $this->resetform();
        $this->showModal =true;
        $this->addMode = true;
        $this->editmode=false;
    }
    public function closeOpenModal(){
        $this->showModal =false;
        $this->editMode = false;
        $this->addMode = false;

    }
    public function upload_image($produk_id){
        {
            // dd($produk_id);
            // $produkId =
        $this->validate([
            'menu_image' => 'required|file|max:20480',
        ]);

        $path=$this->menu_image->store('image', 'public');

        // $get = Menus::where('menu_id',$produk_id)->first();
        $updateMenu=Menus::where('menu_id',$produk_id)->update([
            'image' => $path,
        ]);
        // dd($get);


        // session()->flash('success', 'File berhasil diupload.');
        $this->dispatch('notify', message: 'Image upload success');


        $this->reset('menu_image');
    }
    }
    public function save(){
        // dd($this->items->id);
        // dd([$this->items,
        //     $this->menu_description,
        //     $this->menu_uom,
        //     $this->menu_harga,
        //     $this->menu_visibility]);

        $results=Menus::where("menu_id",$this->menuId)->first();
        if(!$results){
            // $itemcount = count($this->items) ?? '0';
            // dd($this->items);
            // dd($this->itemQty.);

            foreach ($this->items as $index => $item) {
            // dd($this->itemQty[$index] ?? 0);
            // dd($this->items);

                $create_items = menu_item::create([
                    'menu_id'=> $this->menuId,
                    'description' => $item['description'],
                    'produk_id' => $item['produk_id'],
                    'uom' =>$item['uom'],
                    'qty' =>$this->itemQty[$index],
                    'harga' =>$item['harga'],
                    'flaq' =>'1',


                ]);
            }


            $create = Menus::create([
            'menu_id'=>$this->menuId,
            'description' => $this->menu_description,
            'kategori' => $this->menu_kategori,
            'uom' => $this->menu_uom,
            'item_qty' => $this->menu_qty,
            'sellingPrice' =>$this->menu_harga,
            'flaq' => $this->menu_visibility,
            // 'produk_id' => $item['id'],
            // 'item_qty' =>$this->itemQty,

            ]);


        }else{
        $update = $results->update([
            'description' => $this->menu_description,
            'kategori' => $this->menu_kategori,
            'uom' => $this->menu_uom,
            'item_qty' => $this->menu_qty,
            'sellingPrice' =>$this->menu_harga,
            'harga' =>$this->menu_harga,
            'flaq' => $this->menu_visibility,

        ]);
        }
        // $findItem = menu_item::where('menu_id', $this->menuId)->first();
            // dd($this->items);
            // if($findItem){
                // foreach ($this->items as $index => $item) {
                // dd($this->itemQty[$index] ?? 0);

                //   $updateItem = $findItem->where('produk_id',$item['produk_id'])
                //   ->where('menu_id',$this->menuId)->update([
                    // 'menu_id'=> $this->menuId,
                    // 'description' => $item['description'],
                    // 'produk_id' => $item['produk_id'],
                    // 'qty' =>$this->itemQty[$index],


                // ]);
            // }
            // }else{
                // dd($this->items);

            $deleteallitem = menu_item::where('menu_id',$this->menuId)->delete();
            foreach ($this->items as $index => $item) {
            // dd($this->itemQty[$index] ?? 0);
                // dd($this->items);
                // dd($item['uom']);
                $create_items = menu_item::create([
                    'menu_id'=> $this->menuId,
                    'produk_id' => $item['produk_id'],
                    'description' => $item['description'],
                    'qty' =>$this->itemQty[$index],
                    'uom' =>$item['uom'],
                    'harga' =>$item['harga'],
                    'flaq' => '1',

                ]);
            }



        // }
        $this->showModal=false;
        $this->editMode= false;
        $this->addMode= false;
        $this->upload_image($this->menuId);
    }
    public function resetform(){
// dd("reset");
    $this->menuId= '';
    $this->menu_description = '';
    $this->menu_uom = '';
    $this->menu_harga = '';
    $this->items = [];
    }

    public function editMenu($value){
        $this->editMode= true;
        $this->addMode= false;
        $this->resetform();
        // dd($value);
        $editmenu = Menus::where('id',$value)->first();
        // dd($editmenu);
        $menuid = $editmenu->menu_id;


        $editMenuItems= menu_item::where('menu_id',$menuid)->get();

        // dd($editMenuItems);


        // dd($getbaseprice);

        // dd($editMenuItems);
        $this->menuId= $editmenu->menu_id;
        $this->menu_description = $editmenu->description;
        $this->menu_uom = $editmenu->uom;
        $this->menu_qty = $editmenu->item_qty;
        $this->menu_harga= $editmenu->sellingPrice;

        foreach ($editMenuItems as $index => $items) {

        // $getbaseprice= Produk::where('id',$item->produk_id)->first();


            # code...
             $this->items[]=
                [

                    'produk_id'=> $items->produk_id,
                    'description'=>$items->description,
                    'uom'=>$items->uom,
                    'harga'=>$items->harga,
                ];

            $this->itemQty[$index]= $items->qty;


        }



        $this->showModal=true;



    }
    public function updatedSelectProduk($value){
        // dd($value);

    }
    public function selectedProduk(){
        // dd($this->selectProduk);

        if($this->selectProduk != ""){
        $produk = Produk::find($this->selectProduk);
        $this->items[]=
        [
            'produk_id'=> $produk->id,
            'description'=>$produk->description,
            'uom'=>$produk->uom,
            'harga'=>$produk->harga,
        ];
        // dd($this->items);
        }

    }
    public function removeItem($index,$item_id)
    {
        // dd($this->menuId);
        // dd([$index,$item_id,$menu_id]);
         unset($this->items[$index]);
        //  dd([$item_id,$this->menuId]);
         $delete = menu_item::where('produk_id',$item_id)
                              ->where('menu_id',$this->menuId)->delete();
        // dd($delete);
    // rapikan kembali index array
        $this->items = array_values($this->items);
    }
    public function changeitemQty($value){

    // dd($value);

    }
    public function getRandomId(){

        $idRandom = strtoupper(Str::random(3)) . random_int(100000, 999999);
        // dd($idRandom);
        $this->menuId = $idRandom;
    }
}
