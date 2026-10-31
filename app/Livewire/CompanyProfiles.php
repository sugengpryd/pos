<?php

namespace App\Livewire;

use App\Models\Customer as Customers;
use App\Models\Dbcreated as Dbcreated;
use App\Models\CompanyProfile as CompanyProfile;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]



class CompanyProfiles extends Component
{
    public $company_profile ='';
    public $status = '';
    public $Dbcreated='';
    public $companyId='';
    public $namaPT='';
    public $namaToko='';
    public $alamatToko='';
    public $telepon='';
    public $cekprofile='';
    // public $edit =false;
    public $UsersId = '';
    public $editMode = false;
    public $newMode=false;

    // public $save='';

    public function exitcompro(){

        // $this->editMode= false;
        // $this->newMode = true;
        // dd($this->newMode);
        return redirect()->route('dashboard');


    }
    public function mount(){

            $this->UsersId = Auth::user()->id;

            $this->createnewConnection();

            $this->status = request()->query('status');
            // $this->UsersId = Auth::id();
            // dd(Auth::id());
            // dd([
            //         'check' => Auth::check(),
            //         'id' => Auth::id(),
            //         'user' => Auth::user(),
            //     ]);

            $this->cekprofile= CompanyProfile::on('customer_sqlite')->where('userId', $this->UsersId)->exists();
            // dd($cekprofile);

            if(!$this->cekprofile){
            $company_id =now()->format('dmY') . random_int(1000, 9999) . '.' . $this->UsersId;
            $this->companyId = $company_id;
            }else{
            $company_id= CompanyProfile::on('customer_sqlite')->where('userId', $this->UsersId)->first();
            $companyId = $company_id->company_id;
            // dd($companyId);
            $this->companyId = trim($companyId);
            $this->namaPT = $company_id->namaPT;
            $this->namaToko = $company_id->namaToko;
            $this->alamatToko = $company_id->alamattoko;
            $this->telepon = $company_id->telepon;



            };



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

    protected function rules(): array
{
    return [
        'namaPT'      => 'required|string|max:255',
        'namaToko'    => 'required|string|max:255',
        'alamatToko'  => 'required|string|max:500',
        'telepon'     => 'required|string|max:20',
    ];
}

public function save()
{
    // dd($this->editMode);
    // if(!$this->editMode==false){
    //     $this->dispatch(
    //             'notify',
    //             type: 'error',
    //             message: 'click Edit and Save'
    //         );
    // }else{
    //     return;

    // }

    try {
        // Create or configure the customer database connection
        $this->createnewConnection();

        // Validate input
        $this->validate();

        if ($this->cekprofile == false) {
            // dd($this->cekprofile);
            // Insert new company profile
            CompanyProfile::on('customer_sqlite')->create([
                'userId'       => $this->UsersId,
                'company_id'   => $this->companyId,
                'namaPT'       => $this->namaPT,
                'namaToko'     => $this->namaToko,
                'alamattoko'   => $this->alamatToko,
                'telepon'      => $this->telepon,
            ]);

            $this->dispatch(
                'notify',
                type: 'success',
                message: 'Company profile saved successfully!'
            );

        } else {

            // Update existing company profile
            $updated = CompanyProfile::on('customer_sqlite')
                ->where('company_id', $this->companyId)
                ->update([
                    'userId'       => $this->UsersId,
                    'namaPT'       => $this->namaPT,
                    'namaToko'     => $this->namaToko,
                    'alamattoko'   => $this->alamatToko,
                    'telepon'      => $this->telepon,
                ]);

            if ($updated > 0) {
                $this->dispatch(
                    'notify',
                    type: 'success',
                    message: 'Company profile updated successfully!'
                );
            } else {
                $this->dispatch(
                    'notify',
                    type: 'error',
                    message: 'No company profile was updated.'
                );
            }
        }

    } catch (\Illuminate\Validation\ValidationException $e) {

        // Display validation error
        $this->dispatch(
            'notify',
            type: 'error',
            message: $e->validator->errors()->first()
        );

        throw $e;

    } catch (\Throwable $e) {

        // Display database or other errors
        report($e);

        $this->dispatch(
            'notify',
            type: 'error',
            message: 'Failed to save company profile: ' . $e->getMessage()
        );
    }
        $this->editMode= false;

}

    public function edit(){
        // $edit=true;
        // dd($this->editMode);

        $this->editMode= true;



    }

    public function render()
    {
        return view('livewire.company-profile',[ 'status'=> $this->status]);
    }
    public function companyProfile(){

    }
}
