<?php

namespace App\Http\Livewire\Admin\Invoice\Order;

use App\Models\Invoice;
use App\Models\InvoiceService;
use App\Models\InvoiceStatus;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $users;
    public $orders;
    public $statuses;

    public $order;
    public $invoice;

    public $user_id;
    public $order_id;
    public $status_id;
    public $tax;

    public $name;
    public $cost;
    public $amount;
    public $services = [];

    public function mount($invoice_id, $order_id) {
        $this->users = User::all();
        $this->invoice = Invoice::findOrFail($invoice_id);
        $this->order = Order::findOrFail($order_id);
        $this->orders = Order::all();
        $this->statuses = InvoiceStatus::all();

        $this->loadProducts();
        $this->setFormValues();
    }

    public function render()
    {
        return view('livewire.admin.invoice.order.edit')->extends('admin.layouts.app');
    }

    public function addService() {
        $service = new InvoiceService();
        $service->name = $this->name;
        $service->cost = $this->cost;
        $service->amount = $this->amount;

        $this->services[] = $service;
        $this->reset(['name', 'cost', 'amount']);
    }

    public function loadProducts() {
        $services = $this->invoice->services;

        foreach ($services as $product) {
            $service = new InvoiceService();
            $service->name = $product->name;
            $service->cost = $product->cost;
            $service->amount = $product->amount;

            $this->services[] = $service;
        }
    }

    public function setFormValues() {
        $invoice = $this->invoice;
        $this->user_id = $invoice->user_id;
        $this->order_id = $invoice->order_id;
        $this->status_id = $invoice->status_id;
        $this->tax = $invoice->tax;
    }
}
