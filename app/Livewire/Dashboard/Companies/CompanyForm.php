<?php

namespace App\Livewire\Dashboard\Companies;

use App\Models\Company;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\Collection;

class CompanyForm extends Component
{
    use WithFileUploads;

    public ?Company $company = null;
    public Collection $clients;  

    public function render()
    {
        $title = $this->company ? 'Editar Empresa' : 'Cadastrar Empresa';
        return view('livewire.dashboard.companies.company-form')->with('title', $title);
    }

    public function mount(Company $company)
    {
        $this->clients = User::orderBy('name')->where('client', 1)->get();

        if ($company->exists) {
            //$this->company = $company;
        } else {
            //$this->company = new Company();
        }
    }
}
