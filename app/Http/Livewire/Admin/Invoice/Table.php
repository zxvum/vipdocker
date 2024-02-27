<?php

namespace App\Http\Livewire\Admin\Invoice;

use App\Models\Invoice;
use App\Models\UserDocument;
use Livewire\Component;

class Table extends Component
{
    public $invoices;

    // filter
    public $search = '';
    public $status_filter = '-1';
    public $sort_by = 'created_at';
    public $sort_direction = 'ASC';

    public $listeners = ['refreshInvoices'];

    public function mount() {
        $this->invoices = Invoice::query()->orderBy($this->sort_by, $this->sort_direction)->get();
    }

    public function filter()
    {
        if ($this->search !== '') {
            $query = Invoice::query()->where('id', 'like', '%' . $this->search . '%')->orWhere('user_id', 'like', '%' . $this->search . '%');
        } else {
            $query = Invoice::query();
        }

        if ($this->status_filter !== '-1') {
            $query->where('status_id', $this->status_filter);
        }

        $this->invoices = $query->orderBy($this->sort_by, $this->sort_direction)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.invoice.table')->extends('admin.layouts.app');
    }

    public function deleteInvoice($invoice_id) {
        Invoice::findOrFail($invoice_id)->delete();
        $this->emit('refreshInvoices');
    }

    public function refreshInvoices() {
        $this->invoices = Invoice::query()->orderBy($this->sort_by, $this->sort_direction)->get();
    }

    public function createOrderInvoice() {

    }
}
