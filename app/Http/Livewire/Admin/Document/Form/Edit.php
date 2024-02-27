<?php

namespace App\Http\Livewire\Admin\Document\Form;

use App\Models\Document;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpParser\Comment\Doc;

class Edit extends Component
{
    use WithFileUploads;

    public $document = [];

    // fields
    public $name;
    public $template_file;
    public $example_file;
    public $is_active = true;

    public $listeners = ['refreshDocument'];

    protected array $rules = [
        'name' => ['required'],
        'template_file' => ['nullable', 'file', 'max:10240'],
        'example_file' => ['nullable', 'file', 'max:10240'],
    ];

    public function mount($document_id) {
        $this->document = Document::findOrFail($document_id);
        $this->updateDocumentValues($this->document);
    }

    public function submit() {
        $this->validate();

        $document = Document::findOrFail($this->document->id);
        $document->name = $this->name;

        if ($this->template_file) {
            $originalFileName = $this->template_file->getClientOriginalName();
            $filename = pathinfo($originalFileName, PATHINFO_FILENAME) . '.' . $this->template_file->getClientOriginalExtension();
            $this->template_file->storeAs('public/documents/form', $filename);
            $document->template_file = $filename;
        }
        if ($this->example_file) {
            $originalFileName = $this->example_file->getClientOriginalName();
            $filename = pathinfo($originalFileName, PATHINFO_FILENAME) . '.' . $this->example_file->getClientOriginalExtension();
            $this->example_file->storeAs('public/documents/form', $filename);
            $document->example_file = $filename;
        }

        $document->is_active = $this->is_active;
        $document->save();

        $this->emit('refreshDocument');

        $this->dispatchBrowserEvent('success', ['message' => 'Документ успешно обновлен!']);
    }

    public function deleteTemplate() {
        if ($filename = $this->document->template_file) {
            Storage::delete('public/documents/form/'.$filename);
            $this->document->template_file = null;
            $this->document->save();
            $this->dispatchBrowserEvent('success', ['message' => 'Файл успешно удален!']);
        } else {
            Log::error('Файла нет, но админ вызвал удаление!');
            $this->dispatchBrowserEvent('error');
        }
    }

    public function downloadFile($filename) {
        try {
            return Storage::download('public/documents/form/'.$filename);
        } catch (\Exception $e) {
            Log::error('Файл не был найден! '.$e);
            $this->dispatchBrowserEvent('error', ['message' => 'Файл не найден!']);
        }
    }

    public function deleteExample() {
        if ($filename = $this->document->example_file) {
            Storage::delete('public/documents/form/'.$filename);
            $this->document->example_file = null;
            $this->document->save();
            $this->dispatchBrowserEvent('success', ['message' => 'Файл успешно удален!']);
        } else {
            Log::error('Файла нет, но админ вызвал удаление!');
            $this->dispatchBrowserEvent('error');
        }
    }

    public function render()
    {
        return view('livewire.admin.document.form.edit')->extends('admin.layouts.app');
    }

    public function refreshDocument() {
        $this->document = Document::findOrFail($this->document->id);
    }

    public function updateDocumentValues($document) {
        $this->name = $document->name;
        $this->is_active = $document->is_active;
    }
}
