<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Account extends Component
{
    public $name, $surname, $email;

    public function mount(){
        $this->name = auth()->user()->name;
        $this->surname = auth()->user()->surname;
        $this->email = auth()->user()->email;
    }

    public function updateProfile(){
        User::findOrFail(auth()->user()->id)->update([
            'name' => $this->name,
            'surname' => $this->surname,
        ]);
        $this->dispatchBrowserEvent('profileUpdated');
    }

    public function render()
    {
        return view('livewire.profile.account')->extends('layouts.profile')->section('profile');
    }
}
