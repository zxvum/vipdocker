<?php

namespace App\Http\Livewire\Admin\User\Address;

use App\Models\Address;
use App\Models\Country;
use Livewire\Component;
use App\Models\User;

class Edit extends Component
{
    public $address;
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

    public function mount($user_id, $address_id)
    {
        $this->user = User::findOrFail($user_id);
        $this->address = Address::findOrFail($address_id);
        $this->countries = Country::all();

        $this->updateAddressValues($this->address);
    }

    public function updateArticle() {
        $this->validate();

        $this->address->name = $this->name;
        $this->address->surname = $this->surname;
        $this->address->country_id = $this->country_id;
        $this->address->region = $this->region;
        $this->address->city = $this->city;
        $this->address->postal_code = $this->postal_code;
        $this->address->street = $this->street;
        $this->address->phone_number = $this->phone_number;
        $this->address->email = $this->email;
        $this->address->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Адрес пользователя успешно обновлен!']);
    }

    public function render()
    {
        return view('livewire.admin.user.address.edit')->extends('admin.layouts.app');
    }

    public function countryListener($value)
    {
        $this->country_id = $value;
    }

    protected function updateAddressValues($address)
    {
        $this->name = $address->name;
        $this->surname = $address->surname;
        $this->country_id = $address->country_id;
        $this->region = $address->region;
        $this->city = $address->city;
        $this->postal_code = $address->postal_code;
        $this->street = $address->street;
        $this->phone_number = $address->phone_number;
        $this->email = $address->email;
    }
}
