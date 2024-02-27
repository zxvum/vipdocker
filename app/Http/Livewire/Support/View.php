<?php

namespace App\Http\Livewire\Support;

use App\Models\Support;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $support;

    public $selectedImage;

    public function mount($id){
        $this->support = Support::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (!$this->support){
            return abort(404);
        }
    }

    public function openImageModal($image)
    {
        $this->selectedImage = $image;
        $this->dispatchBrowserEvent('openImageModal');
    }

    public function closeImageModal()
    {
        $this->dispatchBrowserEvent('closeImageModal');
    }

    public function render()
    {
        return view('livewire.support.view')->extends('layouts.app');
    }
}
