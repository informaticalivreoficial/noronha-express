<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Title;
use Illuminate\View\View;
use Livewire\WithPagination;
use Livewire\Component;

class UserComponent extends Component
{
    use WithPagination;

    //public User $model;
    //public string $field;
    public bool $isActive;


    public function mount()
    {
        //$this->isActive = (bool) $this->model->getAttribute($this->field);
    }

    #[Title('Usuários')]
    public function render(): View
    {
        $users = User::orderBy('created_at', 'DESC')
                    ->orderBy('status', 'ASC')
                    ->where('client', '1')
                    ->paginate(10);

        return view('livewire.admin.users.index',[
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('livewire.admin.users.edit');
    }    

    public function active($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
    }

}
