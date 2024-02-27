<?php

namespace App\Http\Livewire\Admin\Support;

use App\Models\Support;
use App\Models\SupportStatus;
use Livewire\Component;

class Table extends Component
{
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';
    public $statusFilter = '-1';

    public $tickets = [];
    public $ticketStatuses = [];

    public function mount(){
        $this->tickets = Support::query()->orderBy($this->sortBy, $this->sortDirection)->get();
        $this->ticketStatuses = SupportStatus::all();
    }

    public function filter() {
        if ($this->search !== ''){
            $query = Support::query()->where('title', 'like', '%'.$this->search.'%')->orWhere('id', '=', $this->search);
        } else {
            $query = Support::query();
        }

        if ($this->statusFilter !== '-1') {
            $query->where('status_id', $this->statusFilter);
        }

        $this->tickets = $query->orderBy($this->sortBy, $this->sortDirection)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.support.table')->extends('admin.layouts.app');
    }

    public function deleteTicket($ticket_id){
        $this->tickets->firstWhere('id', $ticket_id)->delete();
        $this->filter();
        $this->dispatchBrowserEvent('success', ['message' => 'Тикет успешно удален!']);
    }
}
