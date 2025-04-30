<?php

namespace App\Livewire\Dashboard\Trips;

use App\Models\Trip;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Trips extends Component
{
    use WithPagination;

    public string $search = '';

    public string $sortField = 'id';

    public string $sortDirection = 'desc';

    public $delete_id;

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

    public function render()
    {
        $title = 'Gerenciar Viagens';
        $trips = Trip::query()->when($this->search, function($query){
            $query->orWhere('start', 'LIKE', "%{$this->search}%");
            $query->orWhere('stop', "%{$this->search}%");
        })->orderBy($this->sortField, $this->sortDirection)->paginate(50);
        return view('livewire.dashboard.trips.trips',[
            'trips' => $trips
        ])->with('title', $title);
    }

    public function setDeleteId($id)
    {
        $this->delete_id = $id;
        $this->dispatch('delete-prompt');        
    }

    #[On('goOn-Delete')]
    public function delete()
    {
        $trip = Trip::find($this->delete_id);
        
        if ($trip) {
            $trip->delete();
            $this->delete_id = null;

            $this->dispatch('swal', [
                'title' => 'Sucesso!',
                'icon' => 'success',
                'text' => 'Viagem removida com sucesso!'
            ]);
        } else {
            $this->dispatch('swal', [
                'title' => 'Error!',
                'icon' => 'error',
                'text' => 'Viagem não encontrada!'
            ]);
        }
    }
}
