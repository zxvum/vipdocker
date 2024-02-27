<?php

namespace App\Http\Livewire\Order\Products;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductShop;
use Livewire\Component;

class Edit extends Component
{
    public $product = [];
    public $order = [];
    public $shops = [];

    // fields
    public $shop;
    public $link;
    public $title;
    public $options;
    public $price = 0.0;
    public $quantity = 1;

    protected $rules = [
        'shop' => ['required', 'exists:order_product_shops,id'],
        'link' => ['required', 'url'],
        'title' => ['required', 'string'],
        'options' => ['string'],
        'price' => ['required', 'integer'],
        'quantity' => ['required', 'integer']
    ];

    public function mount($order_id, $product_id){
        $this->order = Order::findOrFail($order_id);
        $this->product = OrderProduct::findOrFail($product_id);
        $this->shops = OrderProductShop::all();

        $this->setValues();
    }

    public function editProduct(){
        $this->validate();
        $this->product->update([
            'shop_id' => $this->shop,
            'link' => $this->link,
            'title' => $this->title,
            'options' => $this->options,
            'price' => $this->price,
            'quantity' => $this->quantity
        ]);
        $this->setValues();
        $this->dispatchBrowserEvent('productEdited');
    }

    public function setValues(){
        $this->shop = $this->product->shop_id;
        $this->link = $this->product->link;
        $this->title = $this->product->title;
        $this->options = $this->product->options;
        $this->price = $this->product->price;
        $this->quantity = $this->product->quantity;
    }

    public function render()
    {
        return view('livewire.order.products.edit')->extends('layouts.app');
    }
}
