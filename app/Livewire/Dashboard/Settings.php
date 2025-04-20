<?php

namespace App\Livewire\Dashboard;

use App\Models\Config;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\Title;

class Settings extends Component
{
    public array $configData = [];

    public function mount(Config $config)
    {
        $this->configData = $config->toArray();
    }

    // public function save()
    // {
    //     $this->validate([
            
    //         'config.status' => 'required|boolean',
    //         'config.init_date' => 'required|date',
    //         'config.app_name' => 'required|string|max:255',
    //         'config.social_name' => 'required|string|max:255',
    //         'config.alias_name' => 'required|string|max:255',
    //         'config.slug' => 'required|string|max:255',
    //         'config.cnpj' => 'required|string|max:255',
    //         'config.ie' => 'required|string|max:255',
    //         'config.domain' => 'required|string|max:255',
    //         'config.subdomain' => 'required|string|max:255',
    //         // Add other validation rules as needed
    //     ]);

    //     $this->config->save();

    //     session()->flash('success', 'Empresa atualizada com sucesso!');
    // }

    #[Title('Configurações')]
    public function render()
    {
        return view('livewire.dashboard.settings');
    }

    public function updatedConfigDataZipcode(string $value)
    {
        $cep = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cep) === 8) {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/")->json();

            if (!isset($response['erro'])) {
                $this->configData['street'] = $response['logradouro'] ?? '';
                $this->configData['neighborhood'] = $response['bairro'] ?? '';
                $this->configData['state'] = $response['uf'] ?? '';
                $this->configData['city'] = $response['localidade'] ?? '';
                $this->configData['complement'] = $response['complemento'] ?? '';
            } else {
                $this->dispatch('toast', message: 'CEP não encontrado!', notify: 'error');
            }
        }
    }
}
