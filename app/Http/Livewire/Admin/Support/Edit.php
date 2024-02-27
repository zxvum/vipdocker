<?php

namespace App\Http\Livewire\Admin\Support;

use App\Models\Support;
use App\Models\SupportAttachment;
use App\Models\SupportStatus;
use App\Models\SupportTheme;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $ticket;

    public $users = [];
    public $themes = [];
    public $statuses = [];

    public $selectedImage;

    // fields
    public $user_id;
    public $title;
    public $theme_id;
    public $status_id;
    public $text;
    public $attachments = [];

    protected $rules = [
        'user_id' => ['required', 'integer', 'exists:users,id'],
        'title' => ['required', 'string'],
        'theme_id' => ['required', 'integer', 'exists:support_themes,id'],
        'status_id' => ['required', 'integer', 'exists:support_statuses,id'],
        'text' => ['required', 'string'],
        'attachments.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:10000']
    ];

    public function mount($ticket_id) {
        $this->ticket = Support::findOrFail($ticket_id);

        $this->users = User::all();
        $this->themes = SupportTheme::all();
        $this->statuses = SupportStatus::all();

        $this->setTicketData();
    }

    public function updated($field) {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('livewire.admin.support.edit')->extends('admin.layouts.app');
    }

    public function update() {
        $this->validate();

        $this->ticket->user_id = $this->user_id;
        $this->ticket->title = $this->title;
        $this->ticket->theme_id = $this->theme_id;
        $this->ticket->status_id = $this->status_id;
        $this->ticket->text = $this->text;

        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                try {
                    $this->ticket->deleteAttachments();
                    Storage::delete('/app/public/'.$this->user_id);

                    $path = $attachment->store('support-ticket-images/'.$this->user_id, 'public');
                    $filename = $attachment->getClientOriginalName();
                    SupportAttachment::create([
                        'support_id' => $this->ticket->id,
                        'filename' => $filename,
                        'path' => $path
                    ]);
                } catch (\Exception $e) {
                    // Log the error or show an error message to the user
                    Log::error('SupportAttachment upload failed: ' . $e->getMessage());
                    $this->dispatchBrowserEvent('error', ['message' => 'Не удалось загрузить файл!']);
                }
            }
        }

        return to_route('admin.support.table')->with('success', 'Тикет успешно обновлен!');
    }

    protected function setTicketData() {
        $this->user_id = $this->ticket->user_id;
        $this->title = $this->ticket->title;
        $this->theme_id = $this->ticket->theme_id;
        $this->status_id = $this->ticket->status_id;
        $this->text = $this->ticket->text;
        $this->attachments = $this->ticket->attachments;
    }

    public function openImageModal($image)
    {
        $this->selectedImage = $image;
        $this->dispatchBrowserEvent('openImageModal');
    }

    public function closeImageModal()
    {
        $this->reset('selectedImage');
        $this->dispatchBrowserEvent('closeImageModal');
    }

    public function downloadImage(){
        $path = storage_path('app/public/'.$this->selectedImage);
        if (file_exists($path)){
            $this->closeImageModal();
            return response()->download($path);
        }
    }
}
