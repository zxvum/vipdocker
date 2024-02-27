<?php

namespace App\Http\Livewire\Admin\Invoice\Package;

use Livewire\Component;

class Create extends Component
{
    public $users;
    public $packages;

    public $services;

    public function render()
    {
        return view('livewire.admin.invoice.package.create');
    }
}
