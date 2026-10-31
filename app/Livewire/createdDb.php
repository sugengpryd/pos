<?php

namespace App\Livewire;

use Livewire\Component;

class CreatedDb extends Component
{

    public function render()
    {
        return view('livewire.createdDb',compact('$this->status'));
    }
}
