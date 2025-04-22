<?php

namespace App\Livewire\Dashboard;

use App\Models\Config;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\Title;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Livewire\Attributes\On;

class Settings extends Component
{
    public array $configData = [];

    public array $tags = [];

    public function mount(Config $config)
    {
        $this->configData = $config->toArray();
        $this->tags = explode(',', $this->configData['metatags'] ?? '');
    }

    public function update()
    {
        $this->validate([
            'configData.app_name' => 'required|min:3',
            'configData.email' => 'required|email',
            //'configData.zipcode' => 'required',
            //'configData.street' => 'required',
            //'configData.neighborhood' => 'required',
            //'configData.city' => 'required',
            //'configData.state' => 'required',
        ]);
        //dd($this->tags);
        $this->configData['metatags'] = implode(',', $this->tags);
        
        Config::updateOrCreate(['id' => 1], $this->configData);
        
        $this->dispatch('toast', message: 'Configurações atualizadas com sucesso!', notify: 'success');
    }

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

    public function getQrCodeSvgProperty()
    {
        return QrCode::size(240)
            ->margin(2)
            //->format('png')
            ->color(0, 0, 255)
            //->merge($this->configData['favicon'] ? : asset('theme/images/chave.png'), 0.3)
            ->generate($this->configData['domain'] ?? env('DESENVOLVEDOR_URL'));
    }

    #[On('updatePrivacyPolicy')]
    public function updatePrivacyPolicy($value)
    {
        $this->configData['privacy_policy'] = $value;
    }
    
}
