<?php

namespace App\Http\Livewire\Components;

use App\Models\OrderProduct;
use App\Models\Package;
use App\Models\PackageHasProduct;
use Livewire\Component;

class ProductsInPackageTable extends Component
{
    public $products_modal;
    public $orders_modal = [];

    public $products = [];
    public $orders = [];

    public function mount($id){
        $user_id = auth()->user()->id;
        $package = Package::find($id);

        $this->products_modal = OrderProduct::whereHas('order', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
            ->whereNotIn('id', function ($query) use ($user_id) {
                $query->select('product_id')
                    ->from('package_has_products')
                    ->where('user_id', $user_id);
            })
            ->get();
        $this->products = $package->products()->with('product')->get();

    }

    public function render()
    {
        return view('livewire.components.products-in-package-table');
    }
}
