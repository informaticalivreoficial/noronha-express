<?php

namespace App\Livewire\Dashboard\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyForm extends Component
{
    use WithFileUploads;

    public ?Company $company = null;

    public function render()
    {
        $title = $this->company ? 'Editar Empresa' : 'Cadastrar Empresa';
        return view('livewire.dashboard.companies.company-form')->with('title', $title);
    }
}
