<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $order = [];

    // fields
    public $title, $description;

    public function rules() {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('orders')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id)
                        ->where('title', '!=', $this->order->title);
                }),
            ]
        ];
    }

    public function mount($order_id) {
        $this->order = Order::findOrFail($order_id);
        $this->setFormValues();
    }

    public function editOrder(){
        $this->validate();
        $this->order->update([
            'title' => $this->title,
            'description' => $this->description
        ]);
        $this->dispatchBrowserEvent('orderEdited');
        $this->reset(['title', 'description']);
        $this->setFormValues();
    }

    public function setFormValues() {
        $this->title = $this->order->title;
        $this->description = $this->order->description;
    }

    public function render()
    {
        return view('livewire.order.edit')->extends('layouts.app');
    }
}
