<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Discount as discount;
use App\Models\Menu;
use App\Models\Menu_item;
use App\Models\Customer;
use App\Models\pengiriman;
use App\Models\CompanyProfile as Compro;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Dbcreated;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;


class StrukController extends Controller
{
    public $UsersId = '';
    public $dbconnection = '';

    public function createnewConnection(){
    $UsersId =Auth::user()->id;
        $this->dbconnection = 'customer_sqlite';
        $result = Dbcreated::where('users_id', $UsersId)->first();
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




    public function do( Request $request){
        $this->createnewConnection();
         if(!$request){
     }else{
                $batch_id = $request->query('batch_Id');
                $customer_id = $request->query('customer_id');

                // dd([$batch_id,$customer_id]);

                $customer = Customer::on('customer_sqlite')->where('id',$customer_id)->first();
                $transaksi = Transaksi::on('customer_sqlite')->where('batch_id',$batch_id)->first();
                $sumtotal = Transaksi::on('customer_sqlite')->where('batch_id',$batch_id)->sum('total');
                $totalQty = Transaksi::on('customer_sqlite')->where('batch_id',$batch_id)->sum('qty');
                $pengiriman = pengiriman::on('customer_sqlite')->where('batch_id',$batch_id)->first();
                // dd($pengiriman);
                // dd($totalQty);
                $menu = menu::on('customer_sqlite')
                        ->join('transaksi','transaksi.menu_id', '=', 'menu.menu_id')
                        ->select(
                            'menu.*','transaksi.*')
                        ->where('transaksi.batch_id',$batch_id)
                        ->get();
                        // dd([$customer,$transaksi,$sumtotal,$menu,]);

                $toko =  Compro::on('customer_sqlite')->where('userId',Auth::user()->id)->first();

                // dd($toko);
                return view('deliveryOrder',compact('toko','customer','transaksi','menu','sumtotal','totalQty','pengiriman'));




            }
    }

    public function show(Request $request){
        $this->createnewConnection();

        // dd($request);
     if(!$request){
        // return;
     }else{
        $batch_id = $request->query('batch_Id');
        $customer_id = $request->query('customer_id');

        // dd([$batch_id,$customer_id]);

        $customer = Customer::on('customer_sqlite')->where('id',$customer_id)->first();
        $transaksi = Transaksi::on('customer_sqlite')->where('batch_id',$batch_id)->first();
        $sumtotal = Transaksi::on('customer_sqlite')->where('batch_id',$batch_id)->sum('total');
        // $diskon = discount::select('discount')->where('batch_id',$batch_id)->first('discount') ?? 0;
        // $diskon = (float) $diskon->discount;
        $diskon = (float) (
            discount::on('customer_sqlite')->where('batch_id', $batch_id)
        ->value('discount') ?? 0
            );
        $totalQty = Transaksi::on('customer_sqlite')->where('batch_id',$batch_id)->sum('qty');
        $biayaKirim = $request->biayaKirim;
        $totalTagihan = $request->totalTagihan;
        $Ppn= ($sumtotal * 0.11)*0;
    // dd($Ppn);


        // dd($biayaKirim);

        // dd(this->biayaKirim);


        $menu = menu::on('customer_sqlite')
                ->join('transaksi','transaksi.menu_id', '=', 'menu.menu_id')
                ->select(
                    'menu.*','transaksi.*')
                ->where('transaksi.batch_id',$batch_id)
                ->get();
        $toko =  Compro::on('customer_sqlite')->where('userId',Auth::user()->id)->first();


    return view('struk',compact('toko','customer','transaksi','menu','sumtotal','totalQty','biayaKirim','totalTagihan','Ppn','diskon'));
            }

    }



}
