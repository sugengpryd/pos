<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi as Transaksis;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class Transaksi extends Component

{
    public $FilterBatchId = '';
    public $FilterMenu = '';
    public $FilterCustomer = '';
    public $FilterStatus = '';
    public $FilterDate = '';

    public function render()
    {
        // $batchId = Transaksis::select('batch_id')->distinct()->get();
        $batchId = Transaksis::distinct()->pluck('batch_id');
        $menuId = Transaksis::distinct()->pluck('menu_id');
        $customerId = Transaksis::distinct()->pluck('customer_Id');
        $status = Transaksis::distinct()->pluck('flaq');
        // $created_at = Transaksis::distinct()->pluck('created_at');
        $created_at = Transaksis::query()
            ->selectRaw('DATE(created_at) as created_date')
            ->distinct()
            ->pluck('created_date');
        // dd($created_at);

        // dd($batchId);

        $transaksi= Transaksis::query()
        ->when($this->FilterBatchId, function ($query) {
            $query->where('batch_id','like', "%" . $this->FilterBatchId. "%");

        })
        ->when($this->FilterMenu, function ($query) {
            $query->where('menu_id','like', "%" . $this->FilterMenu. "%");

        })
        ->when($this->FilterCustomer, function ($query) {
            $query->where('customer_Id', "=" , $this->FilterCustomer);

        })
        ->when($this->FilterStatus, function ($query) {
            $query->where('flaq', "=" , $this->FilterStatus);

        })
        ->when($this->FilterDate, function ($query) {
            $query->where('created_at', "like" , "%" . $this->FilterDate . "%");

        })
        ->get();

        $total = $transaksi->sum('total');
        $qty = $transaksi->sum('qty');

        return view('livewire.transaksi',compact('transaksi','batchId','menuId','customerId','total','qty','status','created_at'));
    }
}
