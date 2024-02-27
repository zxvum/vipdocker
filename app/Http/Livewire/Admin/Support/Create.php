<?php

namespace App\Http\Livewire\Admin\Support;

use App\Models\Support;
use App\Models\SupportAttachment;
use App\Models\SupportStatus;
use App\Models\SupportTheme;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $users = [];
    public $themes = [];
    public $statuses = [];

    // fields
    public $user_id = "1";
    public $title;
    public $theme_id = "1";
    public $status_id = "1";
    public $text;
    public $attachments = [];

    public $listeners = ['userListener', 'themeListener', 'statusListener'];

    protected $rules = [
        'user_id' => ['required', 'integer', 'exists:users,id'],
        'title' => ['required', 'string'],
        'theme_id' => ['required', 'integer', 'exists:support_themes,id'],
        'status_id' => ['required', 'integer', 'exists:support_statuses,id'],
        'text' => ['required', 'string'],
        'attachments.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:10000']
    ];

    public function updated($field) {
        $this->validateOnly($field);
    }

    public function mount() {
        $this->users = User::all();
        $this->themes = SupportTheme::all();
        $this->statuses = SupportStatus::all();
    }

    public function create() {
        $this->validate();

        $support = new Support();
        $support->user_id = $this->user_id;
        $support->title = $this->title;
        $support->theme_id = $this->theme_id;
        $support->status_id = $this->status_id;
        $support->text = $this->text;
        $support->save();

        foreach ($this->attachments as $attachment) {
            try {
                $path = $attachment->store('support-ticket-images/'.$this->user_id, 'public');
                $filename = $attachment->getClientOriginalName();
                SupportAttachment::create([
                    'support_id' => $support->id,
                    'filename' => $filename,
                    'path' => $path
                ]);
            } catch (\Exception $e) {
                // Log the error or show an error message to the user
                Log::error('SupportAttachment upload failed: ' . $e->getMessage());
                $this->dispatchBrowserEvent('error', ['message' => 'Не удалось загрузить файл!']);
            }
        }

        return to_route('admin.support.table')->with('success', 'Тикет успешно создан!');
    }

    public function render()
    {
        return view('livewire.admin.support.create')->extends('admin.layouts.app');
    }

    public function userListener($value) {
        $this->user_id = $value;
    }
    public function themeListener($value) {
        $this->theme_id = $value;
    }
    public function statusListener($value) {
        $this->status_id = $value;
    }
}
