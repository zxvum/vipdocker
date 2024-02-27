<?php

namespace App\Http\Livewire\Admin\Document\User;

use App\Models\Document;
use App\Models\User;
use App\Models\UserDocument;
use App\Models\UserDocumentStatus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $documents;
    public $users;
    public $statuses;

    public $user_id = 1;
    public $document_id = 1;
    public $document_file;
    public $status_id = 1;

    public $listeners = [
        'userListener',
        'documentListener',
        'statusListener'
    ];

    protected array $rules = [
        'user_id' => ['required', 'integer', 'exists:users,id'],
        'document_id' => ['required', 'integer', 'exists:documents,id'],
        'status_id' => ['required', 'integer', 'exists:user_document_statuses,id'],
    ];

    public function updated($field) {
        $this->validateOnly($field);
    }

    public function mount() {
        $this->documents = Document::all();
        $this->users = User::all();
        $this->statuses = UserDocumentStatus::all();
    }

    public function create() {
        $this->validate();

        $user_document = new UserDocument();
        $user_document->user_id = $this->user_id;
        $user_document->document_id = $this->document_id;
        $user_document->status_id = $this->status_id;

        if ($this->document_file) {
            $fileName = $this->document_file->getClientOriginalName();
            $filePath = "public/documents/user/{$this->user_id}/file";
            Storage::putFileAs($filePath, $this->document_file, $fileName);
        }

        $user_document->save();
        return to_route('admin.documents.user.table')->with('success', 'Документ пользователя был успешно создан!');
    }

    public function render()
    {
        return view('livewire.admin.document.user.create')->extends('admin.layouts.app');
    }

    public function userListener($val) {
        $this->user_id = $val;
    }

    public function documentListener($val) {
        $this->document_id = $val;
    }

    public function statusListener($val) {
        $this->status_id = $val;
    }
}
