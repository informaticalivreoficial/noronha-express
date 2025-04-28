<?php

namespace App\Livewire\Dashboard\Manifests;

use App\Models\Manifest;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class Manifests extends Component
{
    use WithPagination;

    public string $search = '';

    public string $sortField = 'trip';

    public string $sortDirection = 'asc';

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

    #[Title('Viagens')]
    public function render()
    {
        $manifests = Manifest::query()->when($this->search, function($query){
            $query->orWhere('trip', 'LIKE', "%{$this->search}%");
            $query->orWhere('user', "%{$this->search}%");
        })->orderBy($this->sortField, $this->sortDirection)->paginate(50);
        return view('livewire.dashboard.manifests.manifests',[
            'manifests' => $manifests
        ]);
    }
}
