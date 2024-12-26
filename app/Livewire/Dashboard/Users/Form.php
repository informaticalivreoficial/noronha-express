<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Component;

class Form extends Component
{
    public $userId;
    public $name;
    public $email;
    

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
}
