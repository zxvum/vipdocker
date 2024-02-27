<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Order;
use App\Models\Package;
use App\Models\PackageStatus;
use Livewire\Component;

class Table extends Component
{
    public $pagination_limit;
    public $packages = [];
    // sort
    public $search = '';
    public $status_filter = '-1';
    public $package_statuses = [];
    public $sort_by = 'created_at';
    public $sort_direction = 'DESC';

    protected $listeners = ['packagesUpdate' => 'refreshPackages'];

    public function mount(){
        $this->packages = Package::query()->orderBy($this->sort_by, $this->sort_direction)->get();
        $this->package_statuses = PackageStatus::all();
    }

    public function filter(){
        if ($this->search !== ''){
            $query = Order::query()->where('name', 'like', '%'.$this->search.'%');
        } else {
            $query = Order::query();
        }

        if ($this->status_filter !== '-1') {
            $query->where('status_id', $this->statusFilter);
        }

        $this->packages = $query->orderBy($this->sort_by, $this->sort_direction)
            ->get();
    }

    public function delete($id){
        $package = Package::find($id);
        if (!$package) {
            to_route('admin.package.table')->with('error', 'Не удалось найти посылку');
        }

        $package->delete();
        $this->emit('packagesUpdate');
    }

    public function render()
    {
        return view('livewire.admin.package.table')->extends('admin.layouts.app');
    }

    public function refreshPackages()
    {
        $this->packages = $this->filter;
    }
}
