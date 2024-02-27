<?php

namespace App\Http\Livewire\Admin\User\Address;

use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $user;
    public $countries;

    // fields
    public $name;
    public $surname;
    public $country_id;
    public $region;
    public $city;
    public $postal_code;
    public $street;
    public $phone_number;

    public $email;

    public $listeners = [
        'countryListener'
    ];

    protected array $rules = [
        'name' => 'required',
        'surname' => 'required',
        'country_id' => 'required|numeric',
        'region' => 'required',
        'city' => 'required',
        'postal_code' => 'required',
        'street' => 'required',
        'phone_number' => 'required',
        'email' => 'required|email',
    ];

    public function updated($field) {
        $this->validateOnly($field);
    }

    public function mount($user_id) {
        $this->user = User::findOrFail($user_id);
        $this->countries = Country::all();

        $this->country_id = $this->countries->first()->id;
        $this->email = $this->user->email;
        $this->name = $this->user->name;
        $this->surname = $this->user->surname;
    }

    /**
     * @throws \Exception
     */
    public function createAddress() {
        $this->validate();

        try {
            Address::create([
                'user_id' => $this->user->id,
                'name' => $this->name,
                'surname' => $this->surname,
                'country_id' => $this->country_id,
                'region' => $this->region,
                'city' => $this->city,
                'postal_code' => $this->postal_code,
                'street' => $this->street,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }

        return to_route('admin.user.edit', ['user_id' => $this->user->id])->with('success', 'Адрес успешно добавлен!');
    }

    public function render()
    {
        return view('livewire.admin.user.address.create')->extends('admin.layouts.app');
    }

    public function countryListener($value) {
        $this->country_id = $value;
    }
}
