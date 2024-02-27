<?php

namespace App\Http\Livewire\Order\Products;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductShop;
use App\Models\OrderProductStatus;
use Livewire\Component;

class AddProducts extends Component
{
    public $shops = [];
    public $order = [];
    public $products = [];

    // fields
    public $shop;
    public $link;
    public $title;
    public $options;
    public $price = 0.0;
    public $quantity = 1;

    public $listeners = ['updateProducts' => 'refreshProducts'];

    protected $rules = [
        'shop' => ['required', 'exists:order_product_shops,id'],
        'link' => ['required', 'url'],
        'title' => ['required', 'string'],
        'options' => ['string'],
        'price' => ['required', 'integer'],
        'quantity' => ['required', 'integer']
    ];

    public function mount($order_id) {
        $this->order = Order::find($order_id);
        $this->shops = OrderProductShop::orderBy('order', 'ASC')->get();
        $this->products = $this->order->products;

        $this->shop = $this->shops->first()->id;
    }

    public function createProduct(){
        $this->validate();

        OrderProduct::create([
            'order_id' => $this->order->id,
            'status_id' => OrderProductStatus::first()->id,
            'shop_id' => $this->shop,
            'title' => $this->title,
            'options' => $this->options,
            'link' => $this->link,
            'price' => $this->price,
            'quantity' => $this->quantity
        ]);

        $this->order->status_id = 2;
        $this->order->save();
        $this->emit('updateProducts');
        $this->dispatchBrowserEvent('productCreated');
        $this->reset(['shop', 'link', 'title', 'options', 'price', 'quantity']);
    }

    public function productDelete($product_id){
        OrderProduct::find($product_id)->delete();
        $this->dispatchBrowserEvent('productDeleted');
        $this->emit('updateProducts');

        if ($this->products->count() == 0) {
            $this->order->status_id = 1;
            $this->order->save();
        }
    }

    public function deleteOrder() {
        $this->order->delete();
        return to_route('order.table')->with('success', 'Заказ был успешно удален!');
    }

    public function refreshProducts(){
        $this->products = $this->order->products;
    }

    public function render()
    {
        return view('livewire.order.products.add-products')->extends('layouts.app');
    }
}
