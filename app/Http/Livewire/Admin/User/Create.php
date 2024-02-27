<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $roles;

    public $name;
    public $surname;
    public $email;
    public $password;
    public $balance;
    public $select_role = "user";

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function render()
    {
        return view('livewire.admin.user.create')->extends("admin.layouts.app");
    }

    protected $rules = [
        'name' => 'required',
        'surname' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'balance' => 'required|integer',
        'select_role' => 'required|exists:roles,name'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create_user()
    {
        $this->validate();

        try {
            $user = User::create([
                "name" => $this->name,
                "surname" => $this->surname,
                "email" => $this->email,
                "password" => Hash::make($this->password),
                "balance" => $this->balance,
            ]);

            $user->assignRole($this->select_role);

        } catch (\Exception $e) {
            session("error", "Не удалось создать пользователя");
        }

        return to_route("admin.user.table")->with("success", "Пользователь был успешно создан.");
    }
}
