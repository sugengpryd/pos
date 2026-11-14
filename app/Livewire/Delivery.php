<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\pengiriman as DbPengiriman;
use App\Models\Dbcreated as Dbcreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]


#Layout(["layouts.app"])

class Delivery extends Component
{
    public function render()
    {
        $result = DbPengiriman::all();

        return view('livewire.delivery',compact('result'));
    }
}
