<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderStatus;
use Livewire\Component;

class OrderTable extends Component
{


    public function render()
    {
        return view('livewire.admin.order-table')->extends('admin.layouts.app');
    }
}
