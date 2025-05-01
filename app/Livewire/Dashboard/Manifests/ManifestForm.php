<?php

namespace App\Livewire\Dashboard\Manifests;

use App\Http\Requests\Admin\StoreUpdateManifestRequest;
use App\Models\Company;
use App\Models\Manifest;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ManifestForm extends Component
{
    public ?Manifest $manifest = null;

    public Collection $companies;
    public Collection $clients;
    public Collection $trips;

    public ?int $trip = null;
    public ?int $company = null;
    public ?int $user = null;
    public ?string $status = null;
    public ?string $zipcode = null;
    public ?string $street = null;
    public ?string $number = null;
    public ?string $complement = null;
    public ?string $neighborhood = null;
    public ?string $city = null;
    public ?string $state = null;
    public ?string $information = null;
    public ?string $contact = null;

    public string $type = 'fisica';
    public array $types = ['fisica', 'juridica'];

    public function render()
    {
        $title = $this->manifest ? 'Editar Manifesto' : 'Cadastrar Manifesto';
        return view('livewire.dashboard.manifests.manifest-form')->with([
            'title' => $title,
        ]);
    }

    public function mount()
    {
        $this->companies = Company::orderBy('social_name')->get();
        $this->clients = User::orderBy('name')->where('client', 1)->get();
        $this->trips = Trip::orderBy('start', 'desc')->whereYear('start', now()->year)->get();

        if ($this->manifest) {
            $this->trip = $this->manifest->trip;
            $this->type = $this->manifest->type;
            $this->company = $this->manifest->company;
            $this->user = $this->manifest->user;
            $this->status = $this->manifest->status;
            $this->zipcode = $this->manifest->zipcode;
            $this->street = $this->manifest->street;
            $this->number = $this->manifest->number;
            $this->complement = $this->manifest->complement;
            $this->neighborhood = $this->manifest->neighborhood;
            $this->city = $this->manifest->city;
            $this->state = $this->manifest->state;
            $this->information = $this->manifest->information;
            $this->contact = $this->manifest->contact;
        }        
    }

    public function save()
    {
        $request = new StoreUpdateManifestRequest();
        $request->merge([
            'trip' => $this->trip,
            'type' => $this->type,
            'company' => $this->company,
            'user' => $this->user,
            'status' => $this->status,
            'zipcode' => $this->zipcode,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,
            'information' => $this->information,
            'contact' => $this->contact,
        ]);
        $validated = validator($request->all(), $request->rules())->validate();
        
        //$this->validate([
            //'trip' => 'required|exists:trips,id',
            // 'type' => 'required|in:normal,express',
            // 'company' => 'required|exists:companies,id',
            // 'user' => 'required|exists:users,id',
            // 'status' => 'required|in:pending,completed,canceled',
            // 'zipcode' => 'required|string|max:10',
            // 'street' => 'required|string|max:255',
            // 'number' => 'required|string|max:10',
            // 'complement' => 'nullable|string|max:255',
            // 'neighborhood' => 'required|string|max:255',
            // 'city' => 'required|string|max:255',
            // 'state' => 'required|string|max:2',
            // 'information' => 'nullable|string|max:255',
            // 'contact' => 'nullable|string|max:255',
        //]);

        $data = [
            'trip' => $this->trip,
            'type' => $this->type,
            'company' => $this->company,
            'user' => $this->user,
            'status' => $this->status,
            'zipcode' => $this->zipcode,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,
            'information' => $this->information,
            'contact' => $this->contact,
        ];

        dd($data);
        if ($this->manifest) {
            $this->manifest->update($this->getManifestData());
        } else {
            Manifest::create($this->getManifestData());
        }

        session()->flash('message', $this->manifest ? __('Manifesto atualizado com sucesso!') : __('Manifesto criado com sucesso!'));
        
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
                $this->complement = $response['complemento'] ?? '';
            } else {
                $this->addError('zipcode', 'CEP não encontrado.');
                return;
            }
        }
    }
}