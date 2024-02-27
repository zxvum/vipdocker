<?php

namespace App\Http\Livewire\Profile;

use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;

class BillingAndPayments extends Component
{
    public $invoices = [];

    protected $listeners = ['updateInvoices' => 'refreshInvoices'];

    public function mount() {
        $this->invoices = auth()->user()->invoices;
    }

    public function payInvoice($invoice_id) {
        $invoice = Invoice::find($invoice_id);
        if ($invoice->total_price > auth()->user()->balance) {
            $this->dispatchBrowserEvent('error', ['message' => 'На вашем счете не хватает средств, пополните баланс!']);
        } else {
            $user = auth()->user();
            $user->balance -= $invoice->total_price;
            $user->save();

            $invoice->status_id = 4;
            $invoice->save();

            $this->emit('updateInvoices');
            $this->dispatchBrowserEvent('success', ['message' => 'Счет успешно оплачен! Ждем вас еще)']);
        }
    }

    public function submitPayment(){
        $this->modal_invoice->update([
            'status_id' => 4
        ]);
        $this->emit('updateInvoices');
        $this->closeModal();
        $this->dispatchBrowserEvent('paymentToast');
    }

    public function refreshInvoices() {
        $this->invoices = auth()->user()->invoices;
    }

    public function render()
    {
        return view('livewire.profile.billing-and-payments')->extends('layouts.profile')->section('profile');
    }
}
