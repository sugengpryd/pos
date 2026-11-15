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

        if(empty($this->inputTimezone)){
            // dd($this->inputTimezone);

            $this->dispatch('notify',[
            'type'=>'error',
            'message'=> 'Please Select TimeZone !!!']);
            // dd($this->inputTimezone);

            return;

        }
             $setTmezone = dbUser::where('id',Auth::id())->update([
                'timezone' => $this->timezone,
                'updated_at' => now(),
            ]);

            $this->dispatch('notify',[
                'type'=>'success',
                'message'=> 'TimeZone updated To GMT' . $this->timezone,
            ]);
            // dd($this->inputTimezone);





    }



    public function render()
    {
        // dd(Auth()->user()->timezone);
        $this->timezone = Auth()->user()->timezone ;


        return view('livewire.settings');
    }
}
