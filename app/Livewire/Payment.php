<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Dbcreated as Dbcreated;
use App\Models\Payment as Dbpayment;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Payment extends Component
{
    public $UsersId = '';

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
        $this->createnewConnection();

        $payment= Dbpayment::on('customer_sqlite')->get();
        // dd($payment);

        return view('livewire.payment',compact('payment'));
    }
}
