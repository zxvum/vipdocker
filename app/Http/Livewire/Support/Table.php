<?php

namespace App\Http\Livewire\Support;

use App\Models\Support;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Table extends Component
{
    public $supports = [];
    public $tickets_count = 0;

    public function mount(){
        $this->supports = \auth()->user()->tickets;
        $this->tickets_count = Auth::user()->tickets()->whereDate('created_at', Carbon::today())->count();
    }

    public function render()
    {
        return view('livewire.support.table')->extends('layouts.app');
    }
}
