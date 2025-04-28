<?php

namespace App\Livewire\Dashboard\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class Companies extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $search = '';

    public string $sortField = 'social_name';

    public string $sortDirection = 'asc';

    public bool $active;

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

    #[Title('Empresas')]
    public function render()
    {
        $companies = Company::query()->when($this->search, function($query){
            $query->orWhere('social_name', 'LIKE', "%{$this->search}%");
            $query->orWhere('email', "%{$this->search}%");
        })->orderBy($this->sortField, $this->sortDirection)->paginate(35);
        return view('livewire.dashboard.companies.companies',[
            'companies' => $companies
        ]);
    }

    public function toggleStatus($id)
    {              
        $company = Company::find($id);
        $company->status = !$this->active;        
        $company->save();
        $this->active = $company->status;
    }
}
