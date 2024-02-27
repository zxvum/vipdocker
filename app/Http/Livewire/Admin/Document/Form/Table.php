<?php

namespace App\Http\Livewire\Admin\Document\Form;

use App\Models\Document;
use Livewire\Component;

class Table extends Component
{
    public $documents;

    public $listeners = ['refreshDocuments'];

    public function mount() {
        $this->documents = Document::orderBy('order', 'ASC')->get();
    }

    public function deleteDocument($document_id) {
        $this->documents->where('id', $document_id)->first()->delete();
        $this->dispatchBrowserEvent('success', 'Документ успешно удален!');
        $this->emit('refreshDocuments');
    }

    public function render()
    {
        return view('livewire.admin.document.form.table')->extends('admin.layouts.app');
    }

    public function refreshDocuments() {
        $this->documents = Document::orderBy('order', 'ASC')->get();
    }
}
