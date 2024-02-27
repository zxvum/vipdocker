<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $users = [];
    public $selected_user;
    public $address_id;

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.admin.package.create')->extends('admin.layouts.app');
    }
}
