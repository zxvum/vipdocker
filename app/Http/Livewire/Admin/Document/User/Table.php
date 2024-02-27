<?php

namespace App\Http\Livewire\Admin\Document\User;

use App\Models\User;
use App\Models\UserDocument;
use App\Models\UserDocumentStatus;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Table extends Component
{
    public $documents;
    public $statuses;
    // filters
    public $search = '';
    public $status_filter = '-1';
    public $sort_by = 'created_at';
    public $sort_direction = 'ASC';

    public $listeners = ['refreshDocuments'];

    public function mount() {
        $this->documents = UserDocument::query()->orderBy($this->sort_by, $this->sort_direction)->get();
        $this->statuses = UserDocumentStatus::all();
    }

    public function filter()
    {
        if ($this->search !== '') {
            $query = UserDocument::query()->where('id', 'like', '%' . $this->search . '%')->orWhere('user_id', 'like', '%' . $this->search . '%');
        } else {
            $query = UserDocument::query();
        }

        if ($this->status_filter !== '-1') {
//            $query->whereHas('roles', function ($query) {
//                $query->where('id', $this->role_filter);
//            });
            $query->where('status_id', $this->status_filter);
        }

        $this->documents = $query->orderBy($this->sort_by, $this->sort_direction)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.document.user.table')->extends('admin.layouts.app');
    }

    public function refreshDocuments()
    {
        $this->documents = UserDocument::query()->orderBy($this->sort_by, $this->sort_direction)->get();
    }

    public function deleteDocument($document_id) {
        UserDocument::find($document_id)->delete();
        $this->emit('refreshDocuments');
    }
}
