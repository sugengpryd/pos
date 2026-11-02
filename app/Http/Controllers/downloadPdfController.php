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
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;


class downloadPdfController extends Controller
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

    public function create(Request $request){
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
        $biayaKirim = $request->query('biayaKirim');
        $totalTagihan = $request->query('totalTagihan');
        $Ppn= ($sumtotal * 0.11)*0;





        $menu = menu::on('customer_sqlite')
                ->join('transaksi','transaksi.menu_id', '=', 'menu.menu_id')
                ->select(
                    'menu.*','transaksi.*')
                ->where('transaksi.batch_id',$batch_id)
                ->get();

        $toko =  Compro::on('customer_sqlite')->where('userId',Auth::user()->id)->first();


        $height = 250 + ($menu->count() * 50);

        $pdf = Pdf::loadView('strukPdf',compact('toko','customer','transaksi','menu','sumtotal','totalQty','biayaKirim','totalTagihan','Ppn','diskon'))
        // [lower-left X, lower-left Y, upper-right X, upper-right Y]
        // ->setPaper([0, 0, 164.4, 1000], 'portrait');
        ->setPaper([0, 0, 600, $height], 'portrait');


        // $destinationPath= storage_path("logo/" . $customer->nama . now() . '.pdf');
        $filename = $customer->nama . '_' . now()->format('dmY_His') . '.pdf';

        $destinationPath = storage_path('invoices/' . $filename);

        if (!file_exists(dirname($destinationPath))) {
          mkdir(dirname($destinationPath), 0755, true);
        }

        $pdf->save($destinationPath);

return response()->download($destinationPath, $filename);

    // return response()->streamDownload(
        // fn () => print($pdf->output()),
        // $filename
        // $customer->nama . now() . '.pdf'
    // );


    // return view('struk',compact('toko','customer','transaksi','menu','sumtotal','totalQty','biayaKirim','totalTagihan','Ppn','diskon'));
            // }

    }
  }


}
