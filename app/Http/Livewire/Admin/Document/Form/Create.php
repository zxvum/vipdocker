<?php

namespace App\Http\Livewire\Admin\Document\Form;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $template_file;
    public $example_file;
    public $is_active = true;

    protected array $rules = [
        'name' => ['required'],
        'template_file' => ['nullable', 'file', 'max:10240'],
        'example_file' => ['nullable', 'file', 'max:10240'],
    ];

    public function submit() {
        $this->validate();

        $document = new Document();
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
        $document->order = Document::orderBy('order', 'DESC')->first()->order + 1;
        $document->save();

        $this->reset();

        $this->dispatchBrowserEvent('success', ['message' => 'Документ успешно создан!']);
    }

    public function render()
    {
        return view('livewire.admin.document.form.create')->extends('admin.layouts.app');
    }
}
