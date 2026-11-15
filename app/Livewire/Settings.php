<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\User as dbUser;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]

class Settings extends Component
{
    public $notif ='';
    public $timezone='';
    public $settimezone='';

    public function mount(){
         $notification = dbUser::where('id',Auth::id())->value('updateFlaq');
        $this->notif = $notification;

        $this->timezone = Auth()->user()->timezone ;

        // dd($this->notif);


    }
    public function getTimezone(){

        if(empty($this->timezone)){
            // dd($this->inputTimezone);
            // error
            $this->dispatch('notify',
                message: 'Please Select Timezone !',
                type: 'error'
            );
            return;

        }

        $setTmezone = dbUser::where('id',Auth::id())->update([
                'timezone' => $this->timezone,
                'updated_at' => now(),
            ]);

            // Success
            $this->dispatch('notify',
                message: "Timezone GMT {$this->timezone} Saved !",
                type: 'success'
            );

            // dd($this->inputTimezone);


            // $this->timezone = $this->inputTimezone;


    }



    public function render()
    {
        // dd(Auth()->user()->timezone);



        return view('livewire.settings');
    }
}
