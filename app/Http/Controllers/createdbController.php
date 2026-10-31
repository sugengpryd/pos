<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Dbcreated;
use App\Models\User;
use App\Models\Customer;
use App\Models\Uom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class createdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('createDB');
        $prefix="database_";
        // $dbid = (string) random_int(100000, 999999);
        $dbid = Auth::user()->id;
        $dbname = $prefix . $dbid;




        return view('userDb.createdDb',compact('dbname'));


    }

    public function createdDB($value){
        // dd($value);
        $userId= Auth::user()->id;
        $location='database';
        $dbname =trim($value);
        $path = database_path($dbname .'.sqlite');

        $finddata=Dbcreated::where('users_id',$userId)->first();
        if(!$finddata){
        $create = Dbcreated::create([
            'users_id' => $userId,
            'db_name' => $dbname,
            'path' => $path,
            'flaq' =>'1',

            ]);
        };

        $updateUsers= User::where('id',$userId)->update([
            'dbconnection' =>"customer_sqlite",
            'dbcreated' => "1",

        ]);



        if (!File::exists($path)) {
                File::put($path, '');

            }

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

        // Run migrations on the dynamic SQLite database
    $migrate = Artisan::call('migrate', [
        '--database' => 'customer_sqlite',
        '--path' => 'database/migrations/customers',
        '--force' => true,


    ]);

    // dd(
    //     $migrate,
    //     Artisan::output()
    // );

    //Copy Master Table
    //copy user default to user customer_sqlite
    $user = User::findOrFail(auth()->id());
    if($user){
    // Copy the user data into the new database
    $userData = $user->only([
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        ]);
    };
    // copy user data
    $cekuser = DB::connection('customer_sqlite')->table('users')->where('email',$user->email)->first();
    if(!$cekuser){
    DB::connection('customer_sqlite')
        ->table('users')
        ->insert([
            // 'id' => $user->id,
            // id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
            'name'=>$user->name,
            'email'=>$user->email,
            'email_verified_at'=>$user->email_verified_at ?? null,
            'password'=>$user->password,
            'remember_token'=>$user->remeber_token,
            'dbconnection' =>"customer_sqlite",
            'created_at'=>$user->created_at,
            'updated_at'=>$user->updated_at,
            'dbcreated'=>$user->dbcreated ?? '1',

        ]);
    };


    // copy masteruom
    $masterUom = Uom::all();
    // dd($masterUom);

    $uomdata = $masterUom->map(function ($uom) {
    return [
        'uomkode'    => $uom->uomkode,
        'description' => $uom->description,
        'flaq'        => $uom->flaq,
    ];
        })->toArray();

     $uomnew = DB::connection('customer_sqlite')->table('uoms')->get();

    // dd($uomnew);


    if ($uomnew->isEmpty()) {
    DB::connection('customer_sqlite')
        ->table('uoms')
        ->insert($uomdata);
    }

    // copy master customer
    $masterCustomer = Customer::where('nama','like','%'. 'Regular'. '%')->get();
    // dd($masterCustomer);

    $customerdata = $masterCustomer->map(function ($customer) {
    return [
        'nama'    => $customer->nama,
        'Alamat' => $customer->Alamat,
        'telepon1'        => $customer->telepon1,
        'telepon2'        => $customer->telepon2,
        'kota'            => $customer->kota,

    ];
        })->toArray();

     $customernew = DB::connection('customer_sqlite')
        ->table('customer')->get();


    if ($customernew->isEmpty()) {
    DB::connection('customer_sqlite')
        ->table('customer')
        ->insert($customerdata);
    }

    //---------------------
       //copy Dbcreated
    //    $Dbcreated= Dbcreated::first();
    $Dbcreated = Dbcreated::where('users_id', Auth::user()->id)->first();
    //    dd($Dbcreated);
        // $Dbdata = $Dbcreated->only([
            // 'users_id'=>$Dbcreated->users_id,
            // 'db_name'=>$Dbcreated->db_name,
            // 'size'=>$Dbcreated->size,
            // 'path'=>$Dbcreated->path,
            // 'flaq'=>$Dbcreated->flaq,

        // ]);
        if($Dbcreated){
        DB::connection('customer_sqlite')
        ->table('Dbcreateds')
        ->insert([

            // 'id' => $user->id,
            // id`	integer NOT NULL PRIMARY KEY AUTOINCREMENT,
            'users_id'=>$Dbcreated->id,
            'db_name'=>$Dbcreated->db_name,
            'size'=>$Dbcreated->size,
            'path'=>$Dbcreated->path,
            'flaq'=>$Dbcreated->flaq,

        ]);
        session()->flash('success', 'Database created successfully!');


        };





    // session()->flash('message', 'User copied successfully!');

    session()->flash(
    'success',
    "Database {$dbname}.sqlite created successfully."
    );
    // $this->redirect(route('CreatedbPage'), navigate: true);

    // return redirect()->route('dashboard');


        // return view('livewire.company-profile',[

            // 'Dbcreated' => $Dbcreated,
        // ]);
        // if($Dbcreated){
        //     $status = '1';
        // };
         if(session()->has('success')){
             $status = '1';

         };
         

    // return "Database {$dbname}.sqlite created successfully.";
    return view('userDb.createdDb',compact('dbname','status'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
