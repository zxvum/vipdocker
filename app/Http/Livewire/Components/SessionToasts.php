<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class SessionToasts extends Component
{
    public $timeout = 5000;
    public $progress = true;
    public $closeButton = true;

    public function mount() {
        if (session()->has('success')) {
            $this->dispatchBrowserEvent('success', ['message' => session()->get('success')]);
        }
        if (session()->has('warning')) {
            $this->dispatchBrowserEvent('warning', ['message' => session()->get('warning')]);
        }
        if (session()->has('error')) {
            $this->dispatchBrowserEvent('error', ['message' => session()->get('error')]);
        }
    }

    public function render()
    {
        return view('livewire.components.session-toasts');
    }
}
