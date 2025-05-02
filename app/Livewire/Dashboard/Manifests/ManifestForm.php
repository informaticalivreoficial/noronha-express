<?php

namespace App\Livewire\Dashboard\Manifests;

use App\Http\Requests\Admin\StoreUpdateManifestRequest;
use App\Models\Company;
use App\Models\Manifest;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Enums\StatusOfManifestEnum;
use App\Http\Requests\Admin\StoreUpdateManifestItemRequest;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ManifestForm extends Component
{
    public ?Manifest $manifest = null;

    public Collection $companies;
    public Collection $clients;
    public Collection $trips;

    public array $items = [];

    public ?int $trip = null;
    public ?int $company = null;
    public ?int $user = null;
    public string $status = '';
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

    public function mount(Manifest $manifest)
    {
        $this->companies = Company::orderBy('social_name')->get();
        $this->clients = User::orderBy('name')->where('client', 1)->get();
        $this->trips = Trip::orderBy('start', 'desc')->whereYear('start', now()->year)->get();

        if ($this->manifest) {
            $this->trip = $this->manifest->trip;
            $this->type = $this->manifest->type;
            $this->company = $this->manifest->company;
            $this->user = $this->manifest->user;
            $this->status = $manifest->status instanceof \App\Enums\StatusOfManifestEnum
            ? $manifest->status->value
            : (string) $manifest->status;
            $this->zipcode = $this->manifest->zipcode;
            $this->street = $this->manifest->street;
            $this->number = $this->manifest->number;
            $this->complement = $this->manifest->complement;
            $this->neighborhood = $this->manifest->neighborhood;
            $this->city = $this->manifest->city;
            $this->state = $this->manifest->state;
            $this->information = $this->manifest->information;
            $this->contact = $this->manifest->contact;
            //Items
            $this->items = $manifest->items->toArray();
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

        // $data = [
        //     'trip' => $this->trip,
        //     'type' => $this->type,
        //     'company' => $this->company,
        //     'user' => $this->user,
        //     'status' => $this->status,
        //     'zipcode' => $this->zipcode,
        //     'street' => $this->street,
        //     'number' => $this->number,
        //     'complement' => $this->complement,
        //     'neighborhood' => $this->neighborhood,
        //     'city' => $this->city,
        //     'state' => $this->state,
        //     'information' => $this->information,
        //     'contact' => $this->contact,
        // ];

        // Validação antecipada dos itens
        $validatedItems = collect($this->items)->map(function ($item) {
            $itemRequest = new StoreUpdateManifestItemRequest();
            $itemRequest->merge($item);
            return validator($itemRequest->all(), $itemRequest->rules())->validate();
        });
        
        if ($this->manifest) {
            //$this->manifest->update($data);
            //dd($validatedItems);
            $this->manifest->update($validated);
            
            $this->manifest->items()->delete();
            foreach ($validatedItems as $item) {
                $this->manifest->items()->create($item);
            }
            $this->dispatch(['atualizado']);
        } else {
            //$manifestCreate = Manifest::create($data);
            $manifestCreate = Manifest::create($validated);

            foreach ($validatedItems as $item) {
                $manifestCreate->items()->create($item);
            }            
            $this->dispatch(['cadastrado']);
            $this->manifest = $manifestCreate;
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
                $this->complement = $response['complemento'] ?? '';
            } else {
                $this->addError('zipcode', 'CEP não encontrado.');
                return;
            }
        }
    }

    public function addItem()
    {
        $this->items[] = [
            'unit' => '',
            'description' => '',
            'quantity' => '',
            'horti_fruit' => null,
            'cubage' => null,
            'secure' => null,
            'dry_weight' => null,
            'package' => null,
            'glace' => null,
            'tax' => null,
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // reindexa
    }
}