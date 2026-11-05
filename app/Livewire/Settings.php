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

    public function mount(){
         $notification = dbUser::where('id',Auth::id())->value('updateFlaq');
        $this->notif = $notification;

        // dd($this->notif);


    }



    public function render()
    {

        return view('livewire.settings');
    }
}
