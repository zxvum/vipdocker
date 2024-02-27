<?php

namespace App\Http\Livewire\Admin\Orders\Products;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductShop;
use App\Models\OrderProductStatus;
use Livewire\Component;

class Create extends Component
{
    public $order = [];
    public $shops = [];
    public $statuses = [];

    // fields
    public $status_id = 1;
    public $shop_id = 1;
    public $link;
    public $title;
    public $options;
    public $price = 0.00;
    public $quantity = 1;

    protected $rules = [
        'status_id' => ['required', 'exists:order_product_statuses,id'],
        'shop_id' => ['required', 'exists:order_product_shops,id'],
        'title' => ['required', 'string'],
        'link' => ['required', 'url'],
        'options' => ['required', 'string'],
        'price' => ['required', 'integer'],
        'quantity' => ['required', 'integer']
    ];

    public function mount($order_id) {
        $this->order = Order::findOrFail($order_id);
        $this->shops = OrderProductShop::all();
        $this->statuses = OrderProductStatus::all();
    }

    public function updated($property) {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.admin.orders.products.create')->extends('admin.layouts.app');
    }

    public function updateProduct() {
        $this->validate();

        $order = OrderProduct::create([
            'order_id' => $this->order->id,
            'status_id' => $this->status_id,
            'shop_id' => $this->shop_id,
            'title' => $this->title,
            'link' => $this->link,
            'options' => $this->options,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ]);

        return to_route('admin.order.edit', ['order_id' => $this->order->id]);
    }
}
