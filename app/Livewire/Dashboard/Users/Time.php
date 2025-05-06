<?php

namespace App\Livewire\Dashboard\Users;

use Livewire\Component;
use Livewire\WithPagination;

class Time extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search = '';

    public string $sortField = 'name';

    public $delete_id;

    public string $sortDirection = 'asc';

    public bool $active;

    public function render()
    {
        $title = 'Time de Usuários';
        $users = \App\Models\User::query()->when($this->search, function($query){
            $query->orWhere('name', 'LIKE', "%{$this->search}%");
            $query->orWhere('email', "%{$this->search}%");
        })->where('editor', 1)->orWhere('superadmin', 1)->orderBy($this->sortField, $this->sortDirection)->paginate(15);
        return view('livewire.dashboard.users.time',[
            'users' => $users
        ])->with('title', $title);
    }

    #{Url}
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }
}
