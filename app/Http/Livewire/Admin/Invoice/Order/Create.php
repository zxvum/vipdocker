<?php

namespace App\Http\Livewire\Admin\Invoice\Order;

use App\Models\Invoice;
use App\Models\InvoiceService;
use App\Models\InvoiceStatus;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $users;
    public $orders;
    public $statuses;

    public $user_id;
    public $order_id;
    public $status_id;
    public $tax;

    public $name;
    public $cost;
    public $amount;
    public $services = [];

    protected $queryString = [
        'user_id' => ['except' => ''],
        'order_id' => ['except' => ''],
    ];

    protected array $rules = [
        'user_id' => ['required', 'integer', 'exists:users,id'],
        'order_id' => ['required', 'integer', 'exists:orders,id'],
        'status_id' => ['required', 'integer', 'exists:invoice_statuses,id'],
        'tax' => ['required', 'decimal:0,2']
    ];

    public function mount() {
        $this->users = User::all();
        $this->orders = Order::all();
        $this->statuses = InvoiceStatus::all();

        if ($this->order_id) {
            $this->loadProducts();
        }
    }

    public function addService() {
        $service = new InvoiceService();
        $service->name = $this->name;
        $service->cost = $this->cost;
        $service->amount = $this->amount;
//        $service->order = count($this->services);

        $this->services[] = $service;
    }

    public function deleteService($index) {
        unset($this->services[$index]);
    }

    public function submit() {
        $this->validate();

        $invoice = Invoice::create([
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'order_id' => $this->order_id,
            'tax' => $this->tax
        ]);
        $invoice->total_price = 0;
        $invoice->total_price += $this->tax;

        foreach ($this->services as $service){
            InvoiceService::create([
                'invoice_id' => $invoice->id,
                'name' => $service['name'],
                'cost' => $service['cost'],
                'amount' => $service['amount']
            ]);
            $invoice->total_price += $service['cost'] * $service['amount'];
        }
        $invoice->save();

        return to_route('admin.invoice.table', ['success' => 'Счет успешно выставлен!']);
    }

    public function render()
    {
        return view('livewire.admin.invoice.order.create')->extends('admin.layouts.app');
    }

    public function loadProducts() {
        $order = Order::find($this->order_id);
        $products = $order->products;

        foreach ($products as $product) {
            $service = new InvoiceService();
            $service->name = $product->title;
            $service->cost = $product->price;
            $service->amount = $product->quantity;

            $this->services[] = $service;
            $this->reset(['name', 'cost', 'amount']);
        }
    }
}
