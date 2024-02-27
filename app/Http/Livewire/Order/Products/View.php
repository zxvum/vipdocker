<?php

namespace App\Http\Livewire\Order\Products;

use App\Models\Order;
use App\Models\OrderProduct;
use Livewire\Component;

class View extends Component
{
    public $product = [];
    public $order = [];

    public function mount($order_id, $product_id){
        $this->product = OrderProduct::findOrFail($product_id);
        $this->order = Order::findOrFail($order_id);
    }

    public function render()
    {
        return view('livewire.order.products.view')->extends('layouts.app');
    }
}
