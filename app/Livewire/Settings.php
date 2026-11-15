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
    public $inputTimezone ='';
    public $timezone='';

    public function mount(){
         $notification = dbUser::where('id',Auth::id())->value('updateFlaq');
        $this->notif = $notification;

        // dd($this->notif);


    }
    public function getTimezone(){
        $this->inputTimezone=$this->timezone;

    }



    public function render()
    {

        return view('livewire.settings');
    }
}
