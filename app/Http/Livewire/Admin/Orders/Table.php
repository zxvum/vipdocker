<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderStatus;
use Livewire\Component;

class Table extends Component
{
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';
    public $statusFilter = '-1';

    public $orders = [];
    public $orderStatuses = [];

    public function mount(){
        $this->orders = Order::query()->orderBy($this->sortBy, $this->sortDirection)->get();
        $this->orderStatuses = OrderStatus::all();
    }

    public function filter(){
        if ($this->search !== ''){
            $query = Order::query()->where('title', 'like', '%'.$this->search.'%');
        } else {
            $query = Order::query();
        }

        if ($this->statusFilter !== '-1') {
            $query->where('status_id', $this->statusFilter);
        }

        $this->orders = $query->orderBy($this->sortBy, $this->sortDirection)
            ->get();
    }
    public function render()
    {
        return view('livewire.admin.orders.table')->extends('admin.layouts.app');
    }

    public function deleteOrder($order_id) {
        if ($this->orders->firstWhere('id', $order_id)->delete()) {
            $this->dispatchBrowserEvent('success', ['message' => 'Заказ успешно удален!']);
            $this->filter();
        }
    }
}
