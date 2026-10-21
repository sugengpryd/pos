<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu as Menu;
use App\Models\Menu_item as Menu_item;
use App\Models\Produk as Produk;
use App\Models\Payment as Payment;
use App\Models\Discount as dbDiscount;
use App\Models\kategori as Kategori ;
use App\Models\PPn as Ppn;
use App\Models\Customer as DBCustomer;
use App\Models\Transaksi as dbTransaksi;
use App\Models\batchSequences as dbbatch;
use App\Models\pengiriman as dbpengiriman;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]


class Pos extends Component

{
    public $btnMenu =[];
    public $menuId =[] ;
    public $btnItem = [];
    public $btnKategori =[];
    public $menus=[];
    public $menusitems=[];
    public $menuitemstransaksi=[];
    public $menustransaksi=[];
    public $items = [];
    public $total = 0;
    public $totalSementara = 0;
    public $ppn = 0;
    public $diskon = 0;
    public $totalTagihan= 0;

    public $showModal ='';
    public $customerMode = '';
    // public $pilihCustomer = '';
    public $customers = '';
    public $customerid='';
    public $selectedcustomer='';
    public $selectCustomer='';
    public $alamat='';
    public $kota='';
    public $telepon1='';
    public $telepon2='';
    public $transaksiBatchId='';
    public $batchId='';
    public $formBayar='';
    public $nominalPembayaran='';
    public $tipePembayaran='';
    public $flaqTransaksi='';
    public $createBatch=false;
    public $openDelivery='';
    public $penerima='';
    public $pengirim='';
    public $biayaKirim='0';
    public $biayakirim='0';
    public $namaPenerima='';
    public $alamatPenerima='';
    public $kotaPenerima='';
    public $teleponPenerima='';
    public $namaPengirim='';
    public $alamatPengirim='';
    public $itemQty=0;
    public $showmodalDiscount=false;
    public $discountMode =true;
    // public $discountAmount='0';
    public $discounttype='';
    public $batchidDiscount='0';
    public $customerDiscount='0';
    public $totaltagihanDiscount='0';
    public $discountPersen='0';
    public $discountNominal='0';
    public $divNominal=false;
    public $divPersen=false;
    public $discountAmount='0';
    public $totalDiscount='0';






    // public $Resultcustomers= [];
    public function KotaPenerima(){

    }
    public function simpanbiayakirim(){
    //   $findPenerima = dbpengiriman::where('batch_id', $this->transaksiBatchId)->first();

            $update= dbpengiriman::where('batch_id', $this->transaksiBatchId)->update([
                 'BiayaKirim' => (float) preg_replace('/\D/','',$this->biayaKirim),
            ]);

    }
    public function cekbiayaKirim(){
      $findbiayaKirim = dbpengiriman::select('BiayaKirim')->where('batch_id', $this->transaksiBatchId)->first();
    //   dd($findbiayaKirim);

      $this->biayaKirim = $findbiayaKirim?->BiayaKirim ?? 0;
    //   $this->biayakirim= $findbiayaKirim?->BiayaKirim ?? 0;

    }
    public function findpenerima(){
      $findPenerima = dbpengiriman::where('batch_id', $this->transaksiBatchId)->first();
    //   dd($this->transaksiBatchId);
      if($findPenerima){
        // dump($findPenerima);
      $this->namaPenerima =  $findPenerima->toName;
      $this->alamatPenerima = $findPenerima->toAlamat;
      $this->kotaPenerima = $findPenerima->toKota;
      $this->teleponPenerima = $findPenerima->toNumber;
      $this->biayaKirim = number_format((float) $findPenerima->BiayaKirim,0,'.','.');
      }else{
        // dd($this->transaksiBatchId);
      $this->namaPenerima =  '';
      $this->alamatPenerima = '';
      $this->kotaPenerima = '';
      $this->teleponPenerima = '';
      $this->biayaKirim = '0';
      };

    }
    public function simpanPenerima(){
        $findBatchid = dbpengiriman::where('batch_id', $this->transaksiBatchId)->get();

    if ($findBatchid->isNotEmpty()) {
    $update = dbpengiriman::where(
        'batch_id',
        $this->transaksiBatchId
        )->update([
         'toName'=>$this->namaPenerima,
            'toAlamat'=>$this->alamatPenerima,
            'toKota'=>$this->kotaPenerima,
            'toNumber'=>$this->teleponPenerima,
            'BiayaKirim'=> preg_replace('/\D/','',$this->biayaKirim),





        // if($findBatchid->isNotEmpty()){
        //     //$delete= $findBatchid->delete();
        //     $update= $findBatchid->update([
        //     'toName'=>$this->namaPenerima,
        //     'toAlamat'=>$this->alamatPenerima,
        //     'toNumber'=>$this->teleponPenerima,

            ]);
            }else{
        $createPengiriman = dbpengiriman::create([
            'batch_Id'=>$this->transaksiBatchId,
            // 'fromName'=>
            // 'fromAlamat'=>
            'toName'=>$this->namaPenerima,
            'toAlamat'=>$this->alamatPenerima,
            'toKota'=>$this->kotaPenerima,
            'toNumber'=>$this->teleponPenerima,
            'BiayaKirim'=> preg_replace('/\D/','',$this->biayaKirim),
            'flaq'=>'1',


        ]);
            }
    //  $this->selectCustomer = $this->namaPenerima ;
    //  $this->alamat = $this->alamatPenerima ;
    //  $this->kota  = $this->namaPengirim
    //  $this->telepon1  = $this->namaPengirim
    //  $this->telepon2  = $this->namaPengirim
    }
    public function simpanPengirim(){
        dd("pengirim");
    }
    public function biayakirim(){
        // dd([
        //     $this->totalSementara,
        //      $this->ppn,
        //      $this->diskon,
        // ]);
        $totalTagihan= '0';
        // dd([$this->totalTagihan,$this->biayakirim,$this->biayaKirim]);
        $totalTagihan = number_format(($this->totalSementara + $this->ppn) - (float) preg_replace('/\D/','',$this->diskon));

        $formattotalTagihan= (float) preg_replace('/\D/','',$this->biayaKirim) + (float) preg_replace('/\D/','',$totalTagihan);
        $this->totalTagihan = number_format($formattotalTagihan,0,".",".");
    }
    public function Penerima(){
        $param =$this->penerima;
        // if($param == "new"){
        // dd($param);

        // $this->penerima=true;
        // }else{
        // $this->penerima=false;
        // }

    }

    public function Pengirim(){
        $this->pengirim=true;


    }
    public function closeopenDelivery(){
        $this->biayakirim();
        $this->openDelivery=false;
    }

    public function render()
    {
        $kategori = Kategori::where('flaq','1')->orderBy('description')->get();
        $menu = Menu::where('flaq', '1')->orderBy('kategori')->get();
        $Resultcustomers = DBCustomer::all();
        // dd($Resultcustomers);
        // $cektransaksi = dbTransaksi::where('customer_Id',this)
        $cekTransaksi = dbTransaksi::rightJoin(
                'customer',
                'transaksi.customer_Id',
                '=',
                'customer.id'
            )
            // ->where('flaq','!=', 'paid')
            ->select(
                'transaksi.*',
                'customer.id as customerID',
                'customer.nama as customer_nama',
                'customer.Alamat',
                'customer.telepon1',
                'customer.telepon2'
            )
            ->distinct()->get();

            // $this->menustransaksi=$cekTransaksi;
            // dd($cekTransaksi->distinct()->pluck('customer_nama' ));
            //  dd($cekTransaksi
            //     ->pluck('customer_nama','batch_id')
            //     ->unique()
            //     ->values());
            // dd(
            //     $cekTransaksi
            //     ->unique('batch_id')
            //     ->mapWithKeys(fn ($item) => [
            //      $item->batch_id => $item->customer_nama
            //     ])
            // );
            // $batches = $cekTransaksi
            //     ->unique('batch_id')
            //     ->map(function ($item) {
            //         return [
            //             'id' => $item->customer_Id,
            //             'batch_id' => $item->batch_id,
            //             'nama' => $item->customer_nama,

            //         ];
            //     })
            //     ->values()
            //     ->toArray();

            // dd($batches);


        // dd($menu);
        return view('livewire.pos', compact('menu','kategori', 'Resultcustomers','cekTransaksi'));

    }

    public function getMenu($value){
        // dd($value);
         $this->menus=[];
        // $menu = Menu::where('kategori', trim($value))->get();
        $menu = Menu::where('kategori', 'like', '%' . trim($value) . '%')
                      ->where('flaq','1',)->get();
//     dd(
//     Menu::where('kategori', 'like', '%Air%')
//         ->select('id', 'kategori')
//         ->get()
// );
        // dd($menu);
    //     dd([
    //    'menu' =>$menu,
    // 'value' => $value,
    // 'length' => strlen($value),
    // 'hex' => bin2hex($value),
// ]);
        foreach ($menu as $index => $menus) {
            # code...
            $this->menus[]=[
                'menu_id'=>$menus->menu_id,
                'description'=>$menus->description,
                'kategori'=>$menus->kategori,
                'item_qty'=>$menus->item_qty,
                'uom'=>$menus->uom,
                'sellingPrice'=> $menus->sellingPrice,
                'image'=> $menus->image,
            ];
        }
    }
    public function getItem($value){

        $menuItem = Menu_item::where('menu_id',$value)->get();
        // dd($menuItem);
        foreach ($menuItem as $index => $menuItems) {
            # code...
            $this->items[]=[
                'produk_id'=> $menuItems->produk_id,
                'description'=> $menuItems->description,
                'qty'=> $menuItems->qty,
                'uom'=> $menuItems->uom,

            ];
        }
    }
    public function btnadd($id,$desc){
        // dd([$id,$desc]);
        //  $this->menus=[];
        // $this->menustransaksi = $this->menustransaksi;

        $menustransaksi = Menu::where('menu_id', $id)->get();

        // dd([$menustransaksi,$this->menustransaksi]);


        // $menus = Menu::leftJoin('menu_items', 'menu.menu_id', '=', 'menu_items.menu_id')
        //     ->select(
        //         'menu.id',
        //         'menu.description',
        //         'menu.item_qty',
        //         'menu.uom',
        //         'menu.sellingPrice',
        //         'menu.flaq',
        //         'menu_items.id as item_id',
        //         'menu_items.produk_id',
        //         'menu_items.description as item_description',
        //         'menu_items.qty as item_qty',
        //         'menu_items.flaq as item_flaq',
        //     )->where('menu.menu_id', $id)
        //     ->get();
        foreach ($menustransaksi as $index =>$menustransaksis){
        // $this->menustransaksi = array_values($this->menustransaksi);


        $existingIndex = collect($this->menustransaksi)
         ->search(fn ($item) => $item['menu_id'] == $menustransaksis->menu_id);
        //  dd($existingIndex);

        if ($existingIndex !== false) {
            $this->menustransaksi[$existingIndex]['item_qty']++;

        //  Recalculate total price
            $this->menustransaksi[$existingIndex]['total'] =
            $this->menustransaksi[$existingIndex]['sellingPrice'] * $this->menustransaksi[$existingIndex]['item_qty'];

        } else {

        $this->menustransaksi[]=[
        // $this->menustransaksi=[
             'menu_id'=>$menustransaksis->menu_id,
             'description'=>$menustransaksis->description,
             'kategori'=>$menustransaksis->kategori,
             'item_qty'=>$menustransaksis->item_qty,
             'uom'=>$menustransaksis->uom,
             'sellingPrice'=> $menustransaksis->sellingPrice,
             'total'=> $menustransaksis->item_qty * $menustransaksis->sellingPrice,

            ];
            }
        $this->totalSementara += $menustransaksis->item_qty * $menustransaksis->sellingPrice;

        $this->total = number_format($this->totalSementara,0,'.'.'.');
        $this->itemQty += 1;
        $biayaKirim = (float) preg_replace('/\D/','',$this->biayaKirim);
        // dd($biayaKirim);

        $this->totalTagihan = number_format(($this->totalSementara +  $this->ppn + $biayaKirim) - $this->diskon,0,'.'.'.');
        // $this->totalTagihan = ($this->totalTagihan + $biayaKirim);
        }

        $menuItems = Menu_item::where('menu_id', $id)->get();

        foreach ($menuItems as $index =>$itemtransaksis){


        $this->menuitemstransaksi[]=[
             'produk_id'=> $itemtransaksis->produk_id,
             'description'=> $itemtransaksis->description,
             'qty'=> $itemtransaksis->qty,
             'uom'=> $itemtransaksis->uom,

        ];
        }
        $this->dispatch('notify', message: 'Item added');

    }
    public function openmodaldelivery(){
        $findBatchId = dbpengiriman::where('batch_id',$this->transaksiBatchId)->first();
        // dd($findBatchId);
        $this->namaPenerima = $findBatchId->toName ?? '';
        $this->alamatPenerima=$findBatchId->toAlamat ?? '';
        $this->kotaPenerima=$findBatchId->toKota ??'';
        $this->teleponPenerima=$findBatchId->toNumber ?? '';
        $biayaKirim= $findBatchId->BiayaKirim ??'';
        $this->biayaKirim = preg_replace('/\D/','', $biayaKirim) ??'' ;
        // dd($this->biayakirim);

        $this->openDelivery= true;
    }
    public function openModal($value){
        // dd($value);

        $this->showModal = true;

    }
    public function closeopenModal(){
        $this->showModal = false;

    }
    public function pilihCustomer(){
        // dd($value);
        $this->totalSementara='0';
        $this->total='0';
        $this->totalTagihan ='0';
        $this->biayaKirim ='0';
        $this->itemQty = 0;
        $this->diskon = 0;


        // dd($this->selectedcustomer);

        //  $cekTransaksi = dbTransaksi::leftJoin(
        //         'customer',
        //         'transaksi.customer_Id',
        //         '=',
        //         'customer.id'
        //     )->where('flaq','!=', 'paid')
        //     ->select(
        //         'transaksi.*',
        //         'customer.nama as customer_nama',
        //         'customer.Alamat',
        //         'customer.telepon1',
        //         'customer.telepon2'
        //     )
        //     ->count();

        $selected = DBCustomer::where('id',$this->selectedcustomer)->first();

        // dd($selected);
        $this->customerid =$selected->id;
        $this->selectCustomer = $selected->nama;
        $this->alamat = $selected->Alamat;
        $this->kota = $selected->kota;
        $this->telepon1 =$selected->telepon1;
        $this->telepon2 = $selected->telepon2;


        // $this->createbatchId();

        $cekTransaksi = dbTransaksi::rightJoin(
                'menu',
                'transaksi.menu_Id',
                '=',
                'menu.menu_id'
            )->where('transaksi.flaq','!=', 'paid')->where('transaksi.customer_Id',$this->customerid)
            ->select(
                'transaksi.*',
                'menu.menu_id',
                'menu.description',
                'menu.kategori',
                'menu.item_qty',
                'menu.uom',
                'menu.sellingPrice',
                // 'menu.flaq',
                // 'customer.nama as customer_nama',
                // 'customer.Alamat',
                // 'customer.telepon1',
                // 'customer.telepon2'
            )
            ->distinct()->get();
            // dd($this->menustransaksi);
            // dd($cekTransaksi);

            // $this->menustransaksi[]=$cekTransaksi;
            $sumQty= $cekTransaksi->sum('qty') ?? '0';
            // dd($sumQty);


            if($cekTransaksi->isEmpty()){
                // dd("create BatchId");
                $this->createbatchId();

            }else{
                $this->createBatch =false;
                        $this->menustransaksi = $cekTransaksi->map(function ($item) {
                            return [
                                'menu_id'      => $item->menu_id,
                                'description'  => $item->description,
                                'kategori'     => $item->kategori,
                                'item_qty'     => $item->qty,
                                'uom'          => $item->uom,
                                'sellingPrice' => $item->sellingPrice,
                                'total'        => $item->total,
                            ];
                        })->toArray();
                    // dd($menustransaksi);

                foreach ($this->menustransaksi as $index =>$menustransaksis){
                // $existingIndex = collect($this->menustransaksi);

                // dd($this->menustransaksi[$index]['item_qty']);

                //  Recalculate total price
                    // $this->menustransaksi[$existingIndex]['total'] =
                    // $this->menustransaksi[$existingIndex]['sellingPrice'] * $this->menustransaksi[$existingIndex]['item_qty'];
                    $this->transaksiBatchId = $cekTransaksi[0]['batch_id'];
                    $this->flaqTransaksi = $cekTransaksi[0]['flaq'];
                    // dd($this->flaqTransaksi);
                    $this->totalSementara += $this->menustransaksi[$index]['item_qty'] * $this->menustransaksi[$index]['sellingPrice'];
                    // $this->total = number_format($this->totalSementara,0,'.'.'.');

                    // $this->totalTagihan = number_format(($this->totalSementara + $this->ppn) - $this->diskon,0,'.'.'.');


                }

                $this->findpenerima();
                $this->cekDiskon();
                $this->cekbiayaKirim();
                $this->total = number_format($this->totalSementara,0,'.'.'.');
                $total = preg_replace('/\D/','', $this->totalSementara);
                $ppn= preg_replace('/\D/','', $this->ppn);
                $diskon = preg_replace('/\D/','', $this->diskon);
                $delivery = preg_replace('/\D/','', $this->biayaKirim);


                $this->totalTagihan =  number_format(($total - $diskon)+$ppn+$delivery,0,".",".");
                // $this->totalTagihan = number_format(($this->totalSementara + (float) $this->biayaKirim + $this->ppn) - $this->diskon,0,'.','.');
                $this->itemQty= $sumQty;
                $this->dispatch('notify', message: 'Opening Basket');
            }

            // dd($this->menustransaksi);

    }
public function removeItem($index,$item_id)
    {
        // dd($this->menuId);
        // dd([$index,$item_id,$menu_id]);
         unset($this->menustransaksi[$index]);
        //  dd([$item_id,$this->menuId]);
        //  $delete = menu_item::where('produk_id',$item_id)
                            //   ->where('menu_id',$this->menuId)->delete();
        // dd($delete);
    // rapikan kembali index array
        $this->menustransaksi = array_values($this->menustransaksi);
        // Recalculate total
        $this->calculateTotal();

        $this->dispatch('notify', message: 'Item Transaction removed');

    }
    public function calculateTotal()
    {
            $this->total = collect($this->menustransaksi)->sum(function ($item) {
                return (float) $item['item_qty'] * (float) $item['sellingPrice'];
            });
            $this->totalTagihan = ($this->total - $this->diskon) + $this->ppn + (float) preg_replace('/\D/','',$this->biayaKirim);
            $this->totalSementara =$this->total;
    }

    public function createbatchId(){
        $this->createBatch = true;
        $this->namaPenerima ='';
        // $count = dbTransaksi::whereDate('created_at', today())->count();
        $count = dbbatch::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            // dd($count);

        $batchId = now()->format('Ymd') . '-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        // $idRandom = strtoupper(Str::random(3)) . random_int(100000, 999999);
        // $count= dbTransaksi::count();
        // $BatchId = now()->format('Ymd').$count
        // $batchId = now()->format('Ymd') . '-' . random_int(1000, 9999);
        // dd($idRandom);
        // $this->menuId = $idRandom;
        // dd($batchId);
        $this->transaksiBatchId=$batchId;
        $this->menustransaksi=[];
         $this->dispatch('notify', message: 'New Transaction');
    }

    public function save(){
        if(!$this->menustransaksi){
        $this->dispatch('notify', message: 'No transaction !, Nothing to save !');
        return;
            };

        if (!$this->transaksiBatchId) {
            $this->dispatch('notify', message: 'Transaction Batch ID is empty!');
        return;
            };
        // dd($this->customerid);
        // dd(DB::select('PRAGMA foreign_key_list(transaksi)'));
        $findCustomer = dbTransaksi::where('customer_id',$this->customerid)
            ->where('flaq', '!=', 'paid')->get();
        //  dd($findCustomer);
        if(!$findCustomer){
            // dd("find");
            // dd($this->menustransaksi[1]['menu_id']);
            // dd($this->transaksiBatchId);
            foreach($this->menustransaksi as $index =>$itemTransaksi){
            $createtransaksi = dbTransaksi::create([
            // id
            'batch_id'=>$this->transaksiBatchId,
            'menu_id'=> $itemTransaksi['menu_id'],
            'qty'=>$itemTransaksi['item_qty'],
            'sellingPrice'=>$itemTransaksi['sellingPrice'],
            'total'=>$itemTransaksi['total'],
            'customer_Id'=>$this->customerid,
            'flaq'=> "basket",


                ]);
            }
        }else   {
            // dd("find");
                // $findCustomer->delete();
                foreach ($findCustomer as $item) {
                    $item->delete();
                }
                foreach($this->menustransaksi as $index =>$itemTransaksi){
                    $createtransaksi = dbTransaksi::create([
                     // id
                    'batch_id'=>$this->transaksiBatchId,
                    'menu_id'=> $itemTransaksi['menu_id'],
                    'qty'=>$itemTransaksi['item_qty'],
                    'sellingPrice'=>$itemTransaksi['sellingPrice'],
                    'total'=>$itemTransaksi['total'],
                    'customer_Id'=>$this->customerid,
                    'flaq'=> "basket",


                    ]);
                    // $update = dbTransaksi::where('customer_Id', $this->customerid)
                    // ->where('flaq','!=','paid')->update([
                    //     'batch_id'=>$this->transaksiBatchId,
                    //     'menu_id'=> $itemTransaksi['menu_id'],
                    //     'qty'=>$itemTransaksi['item_qty'],
                    //     'sellingPrice'=>$itemTransaksi['sellingPrice'],
                    //     'total'=>$itemTransaksi['total'],
                    //     // 'customer_Id'=>$this->customerid,
                    //     'flaq'=> "basket",


                    // ]);
                }
                // add to Batch Sequences Table
                $findBatch= dbbatch::where('batch_id', $this->transaksiBatchId)->first();
                if($findBatch){
                    $findBatch->delete();
                }
                $addtoBatch_sequences=dbbatch::create([
                    'batch_id'=>$this->transaksiBatchId
                ]);

        }
        $this->simpanDiscount($this->transaksiBatchId);
        $this->simpanbiayakirim();
        $this->dispatch('notify', message: 'Transaction Saved');
    }

    public function openformBayar(){
        $this->formBayar =true;
    }

    public function closeformBayar(){
        $this->formBayar =false;

    }
    public function bayar(){
        // dd("bayar");
            // $this->$transaksiBatchId;
            // $this->total;
            // $this->$totalTagihan;
            // $this->nominalPembayaran;
            // $this->tipePembayaran;
            // dd($this->transaksiBatchId);
        $exists = Payment::where('batch_id', $this->transaksiBatchId)->exists();

        if ($exists) {
        $this->dispatch('notify',
            message: 'Transaction has been paid, Please make new transaction'
        );

        return;
    }
        $createBayar = Payment::create([
            'batch_id' => $this->transaksiBatchId,
            'total'=> $this->total,
            'discount' => '0',
            'grandtotal' => preg_replace('/\D/','',$this->totalTagihan),
            'nominal' => $this->nominalPembayaran,
            'tipe_payment' => $this->tipePembayaran,
            'flaq'=>'1',
        ]);
        // dd($createBayar);
        if($createBayar){
            $ubahflaq= dbTransaksi::where('batch_id','=', $this->transaksiBatchId)
            ->update([
                'flaq'=>'paid',
            ]);
        }
        $this->flaqTransaksi = 'paid';
        $this->menustransaksi =[];
        $this->formBayar=false;
        $this->dispatch('notify', message: 'Pembayaran Berhasil');



        // $this->resetform();

        // $this->items = [];




    }
    public function updatedflaqTransaksi($value){


    }
    public function openmodaldiscount(){

    $this->batchidDiscount='0';
    $this->customerDiscount='0';
    $this->totaltagihanDiscount='0';
    $this->discountPersenDiscount='0';
    $this->discountnominalDiscount='0';
    $this->discountAmount='0';
// dd(DBCustomer::getCustomer($this->customerid));
    $this->batchidDiscount=$this->transaksiBatchId ?? '';
    $this->customerDiscount= DBCustomer::getCustomer($this->customerid);
    $this->totaltagihanDiscount=$this->total ??'';
    $this->discountPersenDiscount='0' ?? '';
    $this->discountnominalDiscount='0' ?? '';
    $this->discountAmount='0' ?? '';
    $this->showmodalDiscount= true;
    $this->discountMode= true;

    }
    public function closemodalDiscount(){
        $this->discountMode= false;
        $this->showmodalDiscount= false;

    }

    public function save_discount(){
        dd('discount');
    }

    public function UpdatedDiscountType($value){
        if($value=="persen"){
            $this->discountPersen ='0';
            $this->divPersen =true;
            $this->divNominal =false;


        }else{
            $this->discountNominal ='0';
            $this->divNominal =true;
            $this->divPersen =false;



        }
    }
    public function updatedDiscountNominal($value){

    $totalDiscount = (float) preg_replace('/\D/','',$value);
    $totaltagihanDiscount=(float) preg_replace('/\D/','',$this->totaltagihanDiscount);
    $totalAmount = (float) preg_replace('/\D/','',$this->totaltagihanDiscount);
    $biayaKirim = (float) preg_replace('/\D/','',$this->biayaKirim);
    $this->totalDiscount= number_format($totalDiscount,0,".",".");
    $this->discountAmount = number_format( $totaltagihanDiscount -  $totalDiscount);
    $ppn = (float) preg_replace('/\D/','',$this->ppn) ?? '0';
    $totalTagihan = (($totalAmount+ $ppn)-$totalDiscount) + $biayaKirim;
    $this->totalTagihan = number_format($totalTagihan,0,".",".");




    }
    public function updatedDiscountPersen($value){
        $value = (float) preg_replace('/\D/','',$value);
        $totalAmount = (float) preg_replace('/\D/','',$this->totaltagihanDiscount);
        $totalDiscount = ($totalAmount * $value)/100;
        $totalAfter = $totalAmount - $totalDiscount;
        $this->discountAmount = number_format($totalAfter,0,".",".");
        $this->totalDiscount= number_format($totalDiscount,0,".",".");
        $ppn = (float) preg_replace('/\D/','',$this->ppn) ?? '0';
        $biayaKirim = (float) preg_replace('/\D/','',$this->biayaKirim);
        $totalTagihan = (($totalAmount+ $ppn)-$totalDiscount) + $biayaKirim;
        $this->totalTagihan = number_format($totalTagihan,0,".",".");
    }
    public function applyDiscount(){
        // dd("apply");
        $this->diskon = $this->totalDiscount;
    }

    public function cekDiskon(){
        $value = $this->transaksiBatchId ?? '';
        $findData = dbDiscount::where('batch_id',$value)->first();
        if($findData){
            $this->diskon = number_format($findData->discount,0,".",".");
        }

    }

    public function simpanDiscount($value){
        $findData = dbDiscount::where('batch_id',$value)->first();
        // dd($this->total);
        if(!$findData){
                $simpan =dbDiscount::create([

                'batch_id'=> $this->transaksiBatchId,
                'sellingPrice'=> (float) preg_replace('/\D/','',$this->total),
                'discount'=> (float) preg_replace('/\D/','',$this->diskon),
                'flaq'=> '1',


                ]);
        }else{

                $update= dbDiscount::where('batch_id',$value)->update([
                'batch_id'=> $this->transaksiBatchId,
                'sellingPrice'=> (float) preg_replace('/\D/','',$this->total),
                'discount'=> (float) preg_replace('/\D/','',$this->diskon),
                'flaq'=> '1',

                ]);
        }

    }

    public function resetform(){
            // $this->transaksiBatchId ='';
            // $this->total='';
            // $this->totalTagihan='';
            // $this->nominalPembayaran='';
            // $this->tipePembayaran ='';
                // $this->menustransaksi =[];

            // $this->items = [];

    }
                // public function getItemColor($produkId)
                // {
                // $colors = [
                //     'bg-red-500',
                //     'bg-blue-500',
                //     'bg-green-500',
                //     'bg-yellow-500',
                //     'bg-purple-500',
                //     'bg-pink-500',
                //     'bg-indigo-500',
                //     'bg-orange-500',
                // ];

                // Convert ID into a consistent number
                // $index = abs(crc32($produkId)) % count($colors);

                // return $colors[$index];
                // return $colors[abs(crc32((string) $produkId)) % count($colors)];
                // }
}
