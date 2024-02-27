<?php

namespace App\Http\Livewire\Support;

use App\Models\Support;
use App\Models\SupportAttachment;
use App\Models\SupportTheme;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $support;

    public $themes = [];

    public $title = '';
    public $theme_id = 1;
    public $text = '';
    public $files = [];
    public $attachments = [];

    public $selectedImage;

    public function mount($id){
        $this->support = Support::find($id);
        $this->themes = SupportTheme::all();

        $this->title = $this->support->title;
        $this->theme_id = $this->support->theme_id;
        $this->text = $this->support->text;
        $this->attachments = $this->support->attachments;
    }

    protected $rules = [
        'title' => ['required', 'string'],
        'theme_id' => ['required', 'integer', 'exists:support_themes,id'],
        'text' => ['required', 'string'],
        'files' => ['max:5'],
        'files.*' => ['image', 'mimes:jpg,jpeg,png,webp']
    ];

    public function updated($property){
        $this->validateOnly($property);
    }

    public function update(){
        $this->validate();

        $this->support->title = $this->title;
        $this->support->theme_id = $this->theme_id;
        $this->support->status_id = 2;
        $this->support->text = $this->text;
        $this->support->save();

        if ($this->files){
            $this->support->deleteAttachments();
            foreach ($this->files as $attachment) {
                try {
                    $path = $attachment->store('support-ticket-images', 'public');
                    $filename = $attachment->getClientOriginalName();
                    SupportAttachment::create([
                        'support_id' => $this->support->id,
                        'filename' => $filename,
                        'path' => $path
                    ]);
                } catch (\Exception $e) {
                    // Log the error or show an error message to the user
                    Log::error('Attachment upload failed: ' . $e->getMessage());
                    return to_route('support.table')->with('error', 'Attachment upload failed: ' . $e->getMessage());
                }
            }
        }

        return to_route('support.table')->with('success', 'Обращение ID: '.$this->support->id.' успешно обновлено.');
    }

    public function openImageModal($image)
    {
        $this->selectedImage = $image;
        $this->dispatchBrowserEvent('openImageModal');
    }

    public function closeImageModal()
    {
        $this->dispatchBrowserEvent('closeImageModal');
    }

    public function render()
    {
        return view('livewire.support.edit')->extends('layouts.app');
    }
}
