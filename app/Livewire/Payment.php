<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class Payment extends Component
{
    public function save(){

    }
    public function render()
    {
        $payment= payment::all();

        return view('livewire.payment',compact('payment'));
    }
}
