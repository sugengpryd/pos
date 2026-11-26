<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\User as dbUser;
use Livewire\Component;
use Livewire\Attributes\Layout;
use DateTimeZone;

#[Layout('layouts.app')]

class Settings extends Component
{
    public $notif ='';
    public $timezone = 'Asia/Jakarta';
    public $settimezone='';
    public $todayTime ='';
    public $currentTime = '';

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
            // console.log($this->timezone);
            $this->dispatch('timezone-updated', timezone: $this->timezone);

            // Success
            $this->dispatch('notify',
                message: "Timezone GMT {$this->timezone} Saved !",
                type: 'success'
            );

            // dd($this->inputTimezone);


            // $this->timezone = $this->inputTimezone;


    }

public function updatedTimezone($value){
    // dd("updated currentTime");
    //  $this->dispatch('timezone-updated', timezone: $value);

}

    public function render()
    {

        // $timezones = timezone_identifiers_list(
        //   \DateTimeZone::ALL
        // );
        $timezones = collect(
            timezone_identifiers_list(DateTimeZone::ASIA)
            )->mapWithKeys(function ($tz) {
            $offset = now($tz)->format('P');

            return [
                $tz => "(UTC{$offset}) {$tz}"
            ];
        });
        $todaytime =now();



        return view('livewire.settings',['timezones' => $timezones,'todaytime'=>$todaytime]);
    }
}
