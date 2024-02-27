<?php

namespace App\Http\Livewire\Admin\Document\User;

use App\Models\Document;
use App\Models\User;
use App\Models\UserDocument;
use App\Models\UserDocumentStatus;
use Livewire\Component;

class Edit extends Component
{
    public $user_document;
    public $documents;
    public $user;
    public $users;
    public $statuses;

    public $user_id;
    public $document_id;
    public $document_file;
    public $status_id;

    public function mount ($user_id, $document_id) {
        $this->user_document = UserDocument::findOrFail($document_id);
        $this->documents = Document::all();
        $this->user = User::findOrFail($user_id);
        $this->users = User::all();
        $this->statuses = UserDocumentStatus::all();

        $this->user_id = $this->user_document->user_id;
        $this->document_id = $this->user_document->user_id;
        $this->status_id = $this->user_document->user_id;
    }

    public function render()
    {
        return view('livewire.admin.document.user.edit')->extends('admin.layouts.app');
    }
}
