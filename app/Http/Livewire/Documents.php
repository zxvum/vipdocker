<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\UserDocument;
use App\Models\UserDocumentStatus;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithFileUploads;
use Str;

class Documents extends Component
{
    use WithFileUploads;

    public $documents;
    public $statuses;
    public $userDocuments;
    public $files = [];
    public $selectedDocument;

    public $listeners = ['updateDocuments' => 'refreshDocuments'];

    protected $rules = [
        'files.*' => 'max:10240'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        if (Str::startsWith($propertyName, 'files.')) {
            $suffix = Str::after($propertyName, 'files.');
            $this->uploadDocument($suffix);
        }
    }

    public function mount()
    {
        $this->documents = Document::all();
        $this->statuses = UserDocumentStatus::all();
        $this->userDocuments = UserDocument::where('user_id', auth()->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.documents')->extends('layouts.app');
    }

    public function uploadDocument($suffix)
    {
        if ($this->selectedDocument == null) {
            $this->dispatchBrowserEvent('document_not_set');
        }

        $document = $this->documents->firstWhere('id', $this->selectedDocument);

        $file = $this->files[$suffix];
        $ext = $file->getClientOriginalExtension();
        $filename = $document->name . '_' . auth()->id() . '.' . $ext;

        $file->storeAs('public/user_documents', $filename);
        UserDocument::create([
            'user_id' => auth()->id(),
            'document_id' => $this->selectedDocument,
            'document_path' => $filename,
            'status_id' => 2
        ]);

        $this->reset('files');
        $this->emit('updateDocuments');
        $this->dispatchBrowserEvent('successUploaded');
    }

    public function downloadDocument($filename)
    {
        if (auth()->user()->documents()->where('document_path', $filename)->first()) {
            return response()->download(storage_path('app/public/user_documents/' . $filename));
        }
    }

    public function deleteDocument($userDocumentId)
    {
        if (auth()->user()->documents()->where('id', $userDocumentId)->first()) {
            UserDocument::findOrFail($userDocumentId)->delete();
            $this->dispatchBrowserEvent('successDeleted');
            $this->emit('updateDocuments');
        }
    }

    public function downloadDocumentFile($filename)
    {
        return response()->download(storage_path('app/public/documents/' . $filename));
    }

    public function getStatusName($documentId)
    {
        $userDocument = $this->userDocuments->where('document_id', $documentId)->first();

        return $userDocument ? $userDocument->status->name : $this->statuses->first()->name;
    }

    public function hasUserDocument($documentId)
    {
        return $this->userDocuments->contains('document_id', $documentId);
    }

    public function refreshDocuments()
    {
        $this->documents = Document::all();
        $this->userDocuments = UserDocument::where('user_id', auth()->user()->id)->get();
    }

    public function setDocument($id){
        $this->selectedDocument = $id;
    }
}
