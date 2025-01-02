<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $userId;

    public $name;
    public $nasc;
    public $email;
    public $cell_phone;
    public $whatsapp;
    public $additional_email;

    public $password;
    

    public function mount($userId = null)
    {
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $this->userId = $user->id;
                $this->name = $user->name;
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.users.form');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->dispatch('userId');
    }
}
