<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SecurityUpdatePasswordForm extends Component
{
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;

    public function rules(){
        return [
            'currentPassword' => [
                'required',
            ],
            'newPassword' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // хотя бы один символ нижнего регистра
                'regex:/\d|\s|\W+/', // хотя бы одна цифра, символ или пробел
            ],
            'confirmPassword' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // хотя бы один символ нижнего регистра
                'regex:/\d|\s|\W+/', // хотя бы одна цифра, символ или пробел
                'same:newPassword'
            ]
        ];
    }

    public function updated($property){
        $this->validateOnly($property);
    }

    public function submit(){
        $this->validate();

        $user = \auth()->user();
        if (!Hash::check($this->currentPassword, $user->password)) {
            return redirect()->back()->with(['error' => 'Текущий пароль неверный.']);
        }

        $user->password = $this->newPassword;
        $user->save();

        session()->flash('success', 'Ваш пароль был успешно обновлен.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.components.security-update-password-form');
    }
}
