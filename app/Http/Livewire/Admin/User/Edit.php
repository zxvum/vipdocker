<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Address;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $user;
    public $roles;
    public $addresses;

    //fields
    public $role_id;
    public $name;
    public $surname;
    public $email;
    public $balance;

    public $listeners = ['roleListener', 'refreshTable'];

    protected array $rules = [
        'name' => ['required', 'string'],
        'surname' => ['required', 'string'],
        'email' => ['required', 'email'],
        'balance' => ['required', 'numeric'],
    ];


    public function mount($user_id)
    {
        $this->user = User::findOrFail($user_id);
        $this->refreshTable();

        $this->updateUserData($this->user);
        $this->roles = Role::all();
    }

    public function createUser() {
        $this->validate();

        if (is_int($this->balance)) {
            $this->balance = number_format($this->balance, 2, '.', '');
        }

        $this->user->update([
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'balance' => $this->balance
        ]);

        $this->user->removeRole($this->user->getRoleNames()->first());
        $this->user->assignRole(Role::findById($this->role_id));

        $this->dispatchBrowserEvent('success', ['message' => 'Пользователь успешно обновлен!']);
    }

    public function render()
    {
        return view('livewire.admin.user.edit')->extends('admin.layouts.app');
    }

    public function updateUser()
    {
        $this->validate();
    }

    public function roleListener($value)
    {
        $this->role_id = $value;
    }

    protected function updateUserData($user) {
        $this->role_id = $user->roles->first()->id;
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;
        $this->balance = $user->balance;
    }

    public function deleteAddress($address_id) {
        Address::findOrFail($address_id)->delete();
        $this->dispatchBrowserEvent('success', ['message' => 'Адрес успешно удален!']);
        $this->emit('refreshTable');
    }

    public function refreshTable() {
        $this->addresses = $this->user->addresses;
    }
}
