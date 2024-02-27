<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class Create extends Component
{
    public $title;
    public $description;

    public function createOrder(){
        $order = Order::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        if ($order) {
            return to_route('admin.order.edit', ['order_id' => $order->id])->with('success', 'Заказ успешно создан, добавьте товары');
        }
    }

    public function render()
    {
        return view('livewire.admin.orders.create')->extends('admin.layouts.app');
    }
}
