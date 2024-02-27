<?php

namespace App\Http\Livewire\Admin\Orders\Products;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductShop;
use App\Models\OrderProductStatus;
use Livewire\Component;

class Edit extends Component
{
    public $order;
    public $product;
    public $shops;
    public $statuses;

    // fields
    public $status_id;
    public $shop_id;
    public $link;
    public $title;
    public $options;
    public $price;
    public $quantity;

    protected $rules = [
        'status_id' => ['required', 'exists:order_product_statuses,id'],
        'shop_id' => ['required', 'exists:order_product_shops,id'],
        'link' => ['required', 'url'],
        'title' => ['required', 'string'],
        'options' => ['nullable', 'string'],
        'price' => ['required', 'integer', 'max_digits:10'],
        'quantity' => ['required', 'integer', 'max:99'],
    ];

    public function mount($order_id, $product_id): void
    {
        $this->order = Order::findOrFail($order_id);
        $this->product = OrderProduct::findOrFail($product_id);
        $this->shops = OrderProductShop::all();
        $this->statuses = OrderProductStatus::all();

        $this->loadProductData();
    }

    public function submit(): void
    {
        $validated_data = $this->validate();
        $this->product->update($validated_data);
        $this->dispatchBrowserEvent('productUpdated');
    }

    public function render()
    {
        return view('livewire.admin.orders.products.edit')->extends('admin.layouts.app');
    }

    private function loadProductData(): void
    {
        $this->status_id = $this->product->status->id;
        $this->shop_id = $this->product->shop_id;
        $this->link = $this->product->link;
        $this->title = $this->product->title;
        $this->options = $this->product->options;
        $this->price = $this->product->price;
        $this->quantity = $this->product->quantity;
    }
}
