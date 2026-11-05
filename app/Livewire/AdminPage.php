<?php

namespace App\Livewire;
use App\Http\Controllers\createdbController;
use App\Models\User as dbUser;
use App\Models\Dbcreated as dbCreateds;
use App\Models\CompanyProfile as dbCp;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]


class AdminPage extends Component
{
    public $showCustomer = false;
    public $DatabaseUpdate = false;
    public $userList = '';
    public $dbcreateds = '';
    public $update_tipe='';
    public $user_id='';
    public $param = '';
    public $updateFlaq = [];


    // public mount(){
        // $updFlaq = dbUser::where('dbcreated','1')->where('id',$update_tipe)->value('updateFlaq');
        // $this->updateFlaq = $updFlaq;

    // }


    public function render()
    {
        $this->userList = dbUser::all();
        $this->dbcreateds = dbCreateds::all();


        return view('livewire.admin-page',[
            'userList'=> $this->userList,
            'dbcreateds' =>$this->dbcreateds,
        ]);
    }
    public function btnCustomer(){
        // $this->showCustomer = true;
        $this->showCustomer =!$this->showCustomer;
         $this->DatabaseUpdate =false;


    }

    public function btnDatabaseUpdate(){
            $this->DatabaseUpdate =!$this->DatabaseUpdate;


        }


    public function DataUpdate($update_tipe){

        if($update_tipe == 'alluser'){
        // $this->DatabaseUpdate =!$this->DatabaseUpdate;
         $this->showCustomer=false;
         $userList = dbUser::where('dbcreated','1')->get();
         $dbList = dbCreateds::all();
        //  dd($userList);

            foreach ($dbList as $index => $dbLists) {
                    // dd($dbLists->db_name);
                    $dbname=trim($dbLists->db_name);

                 app(createdbController::class)->createdDB($dbname);


            }



         }else{
            // $this->DatabaseUpdate =!$this->DatabaseUpdate;
         $this->showCustomer=false;
         $userList = dbUser::where('dbcreated','1')->where('id',$update_tipe)->get();

         $dbLists = dbCreateds::where('users_id',$update_tipe)->first();
        //  dd($dbLists->db_name);
                    $dbname=trim($dbLists->db_name);

                 app(createdbController::class)->createdDB($dbname);

           }
        }

    // public function btnupdateFlaq($update_tipe,$flaq){
    // dd([
    //     $update_tipe,$flaq
    //     ]);
        // $flaq = dbUser::where('dbcreated','1')->where('id',$update_tipe)->value('updateFlaq');
        // if($flaq=='0'){
        // $this->updateFlaq =1;
        // }else{
        // $this->updateFlaq ='0';


        // }

    // }
    public function btnupdateFlaq($id, $currentFlaq){
    $newFlaq = $currentFlaq == 1 ? 0 : 1;

    dbUser::where('id', $id)->update([
        'updateFlaq' => $newFlaq
        ]);

    $this->updateFlaq[$id] = $newFlaq;
    }


}
