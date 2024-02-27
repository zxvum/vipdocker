<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public $title, $description;

    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('orders')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                }),
            ]
        ];
    }

    public function mount()
    {
        $orders_count = Order::where('user_id', auth()->user()->id)->count();
        $this->title = 'Заказ №' . $orders_count + 1;
    }

    public function createOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'status_id' => 1,
            'title' => $this->title,
            'description' => $this->description
        ]);

        return to_route('order.product.add-product', ['order_id' => $order->id])->with('success', 'Ваш заказ успешно создан, теперь добавьте в него товары.');
    }

    public function render()
    {
        return view('livewire.order.create')->extends('layouts.app');
    }
}
