<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $order;
    public $products;
    public $users;
    public $order_statuses;

    // fields
    public $title;
    public $description;
    public $user_id;
    public $status_id;
    public $admin_message;

    // other
    public $msg;
    public $color;

    public $listeners = ['statusListener', 'userListener'];

    protected $rules = [
        'title' => ['required', 'string'],
        'description' => ['nullable', 'string'],
        'user_id' => ['required', 'integer'],
        'status_id' => ['required', 'integer', 'exists:order_statuses,id'],
        'admin_message' => ['nullable', 'string'],
    ];
    public function mount($order_id): void
    {
        $this->order = Order::findOrFail($order_id);
        $this->users = User::all();
        $this->order_statuses = OrderStatus::all();

        $this->loadProducts();
        $this->loadOrderData();
    }

    public function updated($property): void
    {
        $this->validate();

        if ($property == "user_id") {
            $this->success();
        }
    }

    public function success(): void
    {
        if ($user = User::find($this->user_id)){
            $this->msg = 'Пользователь: '.$user->name.' '.$user->surname;
            $this->color = 'success';
        } else {
            $this->msg = 'Пользователь c ID: '.$this->user_id.' не был найден.';
            $this->color = 'danger';
        }
        if ($this->user_id == ''){
            $this->msg = null;
            $this->color = null;
        }
    }

    public function render()
    {
        return view('livewire.admin.orders.edit')->extends('admin.layouts.app');
    }

    public function updateOrder() {
        $this->validate();
        $this->order->update([
            'title' => $this->title,
            'user_id' => $this->user_id,
            'description' => $this->description,
            'status_id' => $this->status_id,
            'admin_message' => $this->admin_message
        ]);
        $this->loadOrderData();
        $this->dispatchBrowserEvent('success', ['message' => 'Товар успешно обновлен!']);
    }

    public function deleteProduct($product_id) {
        if ($this->order->products->firstWhere('id', $product_id)->delete()) {
            $this->dispatchBrowserEvent('success', ['message' => 'Товар успешно удален!']);
            $this->loadProducts();
        }
    }

    protected function loadOrderData(): void
    {
        $this->title = $this->order->title;
        $this->user_id = $this->order->user_id;
        $this->description = $this->order->description;
        $this->status_id = $this->order->status_id;
        $this->admin_message = $this->order->admin_message;
    }

    public function loadProducts(): void {
        $this->products = $this->order->products;
    }

    public function statusListener($value) {
        $this->status_id = $value;
    }

    public function userListener($value) {
        $this->user_id = $value;
    }
}
