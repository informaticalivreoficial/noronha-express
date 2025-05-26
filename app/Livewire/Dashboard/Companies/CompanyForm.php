<?php

namespace App\Livewire\Dashboard\Companies;

use App\Models\Company;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;

class CompanyForm extends Component
{
    use WithFileUploads;

    public ?Company $company = null;
    public Collection $clients;  

    public ?int $user = null;
    //Contact
    public $phone, $cell_phone, $whatsapp, $email, $additional_email, $telegram;
    //Address
    public $zipcode = '', $street, $neighborhood, $city, $state, $complement, $number;

    protected function rules()
    {
        return [
            'user' => 'required|exists:users,id',
            'zipcode' => 'required|min:8|max:10',
            'email' => 'required|email|unique:companies,email',
            'cell_phone' => 'required|string|min:15',
        ];
    }

    public function render()
    {
        $title = $this->company ? 'Editar Empresa' : 'Cadastrar Empresa';
        return view('livewire.dashboard.companies.company-form')->with('title', $title);
    }

    public function mount(Company $company)
    {
        $this->clients = User::orderBy('name')->where('client', 1)->get();

        //if ($this->company) {
        //    $this->company = $company;
        //} else {
            //$this->company = new Company();
        //}
    }

    public function save()
    {
        $validated = $this->validate();

        //$this->company->user = $validated['user'];
        dd($validated);
        if ($this->company->exists) {
            $this->company->update($validated);
        } else {
            $this->company = Company::create($validated);
        }
    }

    public function updatedZipcode(string $value)
    {
        $cep = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cep) === 8) {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/")->json();

            if (!isset($response['erro'])) {
                $this->street = $response['logradouro'] ?? '';
                $this->neighborhood = $response['bairro'] ?? '';
                $this->state = $response['uf'] ?? '';
                $this->city = $response['localidade'] ?? '';
                //$this->configData['complement'] = $response['complemento'] ?? '';
            } else {
                $this->addError('zipcode', 'CEP não encontrado.'); 
            }
        }
    }
}
