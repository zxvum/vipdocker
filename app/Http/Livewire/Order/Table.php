<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class Table extends Component
{
    public $orders = [];

    public $listeners = ['updateOrders' => 'refreshOrders'];

    public function mount(){
        $this->orders = Order::all();
    }

    public function deleteOrder($order_id){
        Order::find($order_id)->delete();
        $this->emit('updateOrders');
        $this->dispatchBrowserEvent('orderDeleted');
    }

    public function refreshOrders(){
        $this->orders = Order::all();
    }

    public function render()
    {
        return view('livewire.order.table')->extends('layouts.app');
    }
}
