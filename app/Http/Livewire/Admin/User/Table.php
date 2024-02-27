<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Table extends Component
{
    public $users;
    public $roles;
    // filters
    public $search = '';
    public $role_filter = '-1';
    public $sort_by = 'created_at';
    public $sort_direction = 'ASC';

    public $listeners = ['refreshUsers'];

    public function mount()
    {
        $this->users = User::query()->orderBy($this->sort_by, $this->sort_direction)->get();
        $this->roles = Role::all();
    }

    public function filter()
    {
        if ($this->search !== '') {
            $query = User::query()->where('name', 'like', '%' . $this->search . '%')->orWhere('surname', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%');
        } else {
            $query = User::query();
        }

        $query->where("is_delete", 0);

        if ($this->role_filter !== '-1') {
//            $query->whereHas('roles', function ($query) {
//                $query->where('id', $this->role_filter);
//            });
            $role = Role::findById($this->role_filter);
            $query->role($role);
        }

        $this->users = $query->orderBy($this->sort_by, $this->sort_direction)
            ->get();
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            if ($user->id !== auth()->user()->id and !$user->getRoleNames()->contains("owner")) {
                $user->delete();
            }
            $this->emit('refreshUsers');
            $this->dispatchBrowserEvent('warning', ["message" => "Данный пользователь был успешно удален"]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['message' => 'Не удалось удалить данного пользователя.']);
        }
    }

    public function render()
    {
        return view('livewire.admin.user.table')->extends('admin.layouts.app');
    }

    public function refreshUsers()
    {
        $this->users = User::query()->orderBy($this->sort_by, $this->sort_direction)->get();
    }
}
