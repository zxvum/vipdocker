<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Livewire\Component;

class UserIdInput extends Component
{
    public $user_id;
    public $msg;
    public $color;

    protected $rules = [
        'user_id' => 'required|integer'
    ];

    public function updated($property)
    {
        $this->validate();

        if ($user = User::find($this->user_id)){
            $this->msg = 'Пользователь: '.$user->name.' '.$user->surname;
            $this->color = 'success';
        } else {
            $this->msg = 'Пользователь c ID: '.$this->user_id.' не был найден.';
            $this->color = 'danger';
        }
        if ($this->user_id == ''){
            $this->msg = null;
            $this->color = null;
        }
    }

    public function render()
    {
        return view('livewire.components.user-id-input');
    }
}
