<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class View extends Component
{
    public $order = [];
    public $total_price;

    public function mount($order_id){
        $this->order = Order::findOrFail($order_id);

        foreach ($this->order->products as $product) {
            $this->total_price += $product->price;
        }
    }

    public function allowOrder(){
        $this->order->status_id = 3;
        $this->order->save();
        return to_route('order.table')->with('success', 'Заказ успешно подтвержден, ожидайте проверки');
    }

    public function render()
    {
        return view('livewire.order.view')->extends('layouts.app');
    }
}
