<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Menu;
use App\Models\Menu_item;
use App\Models\Customer;
use App\Models\pengiriman;

class StrukController extends Controller
{
    public function do( Request $request){
         if(!$request){
     }else{
                $batch_id = $request->query('batch_Id');
                $customer_id = $request->query('customer_id');

                // dd([$batch_id,$customer_id]);

                $customer = Customer::where('id',$customer_id)->first();
                $transaksi = Transaksi::where('batch_id',$batch_id)->first();
                $sumtotal = Transaksi::where('batch_id',$batch_id)->sum('total');
                $totalQty = Transaksi::where('batch_id',$batch_id)->sum('qty');
                $pengiriman = pengiriman::where('batch_id',$batch_id)->first();
                // dd($pengiriman);
                // dd($totalQty);
                $menu = menu::query()
                        ->join('transaksi','transaksi.menu_id', '=', 'menu.menu_id')
                        ->select(
                            'menu.*','transaksi.*')
                        ->where('transaksi.batch_id',$batch_id)
                        ->get();
                        // dd([$customer,$transaksi,$sumtotal,$menu,]);
                return view('deliveryOrder',compact('customer','transaksi','menu','sumtotal','totalQty','pengiriman'));




            }
    }

    public function show(Request $request){
     if(!$request){
        // return;
     }else{
        $batch_id = $request->query('batch_Id');
        $customer_id = $request->query('customer_id');

        // dd([$batch_id,$customer_id]);

        $customer = Customer::where('id',$customer_id)->first();
        $transaksi = Transaksi::where('batch_id',$batch_id)->first();
        $sumtotal = Transaksi::where('batch_id',$batch_id)->sum('total');
        $totalQty = Transaksi::where('batch_id',$batch_id)->sum('qty');
        $biayaKirim = $request->biayaKirim;
        $totalTagihan = $request->totalTagihan;
        $Ppn= ($sumtotal * 0.11)*0;
    // dd($Ppn);


        // dd($biayaKirim);

        // dd(this->biayaKirim);


        $menu = menu::query()
                ->join('transaksi','transaksi.menu_id', '=', 'menu.menu_id')
                ->select(
                    'menu.*','transaksi.*')
                ->where('transaksi.batch_id',$batch_id)
                ->get();

    return view('struk',compact('customer','transaksi','menu','sumtotal','totalQty','biayaKirim','totalTagihan','Ppn'));
            }

    }



}
