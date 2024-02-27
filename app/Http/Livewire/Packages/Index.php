<?php

namespace App\Http\Livewire\Packages;

use App\Models\Address;
use App\Models\OrderProduct;
use App\Models\Package;
use Illuminate\Support\Collection;
use Livewire\Component;
use function Sodium\add;

class Index extends Component
{
    public $package;
    public $addresses;

    public $products_modal;
    public $orders_modal = [];

    public $products = [];
    public $orders = [];

    //edit modal
    public $title;
    public $address_id;
    public $description;

    public $selected_products = [];

    public function mount($id)
    {
        $user_id = auth()->user()->id;
        $this->package = Package::find($id);
        $this->addresses = Address::where('user_id', auth()->user()->id)->get();

        $this->products_modal = OrderProduct::whereHas('order', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
            ->whereNotIn('id', function ($query) use ($user_id) {
                $query->select('product_id')
                    ->from('package_has_products')
                    ->where('user_id', $user_id);
            })
            ->get();
        $this->products = $this->package->products()->with('product')->get();
        $this->loadEditFormData();
    }

    public function render()
    {
        return view('livewire.packages.index')->extends("layouts.app");
    }

    public function editPackage()
    {
        $package = Package::find($this->package->id);
        $package->update([
            'title' => $this->title,
            'address_id' => $this->address_id,
            'description' => $this->description,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => 'Информация о поссылке успешно изменена']);
    }

    public function add_selected_products()
    {
        foreach ($this->selected_products as $id => $value) {
            if ($value === true) {
                $product = OrderProduct::find($id);
                $this->package->products()->save($product);
            }
        }

        $this->dispatchBrowserEvent('success', ['message' => 'Товары успешно добавлены!']);
    }

    public function loadEditFormData()
    {
        $package = $this->package;
        $this->title = $package->title;
        $this->address_id = $package->address_id;
    }
}
