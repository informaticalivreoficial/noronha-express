<?php

namespace App\Livewire\Dashboard;

use App\Http\Requests\Admin\SettingsRequest;
use App\Models\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Settings extends Component
{
    use WithFileUploads;

    public $configData;

    public string $currentTab = 'dados';

    public $logo;
    public $logo_admin;
    public $favicon;
    public $watermark;
    public $imgheader;
    public $metaimg;

    public array $tags = [];

    public function mount()
    {
        $this->configData = Config::findOrFail(1)->toArray();
        $this->tags = explode(',', $this->configData->metatags ?? '');
        $this->logo = $this->getLogo();
    }

    public function render()
    {
        $title = 'Configurações';
        return view('livewire.dashboard.settings')->with('title', $title);
    }

    public function update()
    {        
        $validated = Validator::make([
            'app_name' => $this->app_name,
            'email' => $this->email,
            'logo' => $this->logo,
        ], (new SettingsRequest())->rules())->validate();

        // $this->validate([
        //     'configData.app_name' => 'required|min:3',
        //     'configData.email' => 'required|email',
        //     'logo' => 'nullable|image|max:1024',
        // ]);
        dd($validated);
        if ($this->logo instanceof TemporaryUploadedFile) {
            // Exclui a foto antiga, se existir
            if (!empty($this->configData['logo']) && Storage::disk('public')->exists($this->configData['logo'])) {
                Storage::disk('public')->delete($this->configData['logo']);
            }
            // Salva a nova imagem e atualiza o caminho
            $path = $this->logo->store('config', 'public');            
            $this->configData['logo'] = $path;
        }
        
        //$this->configData['metatags'] = implode(',', $this->tags);
        $this->configData['metatags'] = implode(',', $this->tags ?? []);
        
        Config::updateOrCreate(['id' => 1], $this->configData);
        $this->reset('logo');
        $this->dispatch('toast', message: 'Configurações atualizadas com sucesso!', notify: 'success');
                
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

    public function getLogo()
    {
        // Verifica se o caminho da imagem está presente e existe no disco
        if (empty($this->configData['logo']) || !Storage::disk('public')->exists($this->configData['logo'])) {
            return url(asset('theme/images/image.jpg')); // Imagem padrão caso não tenha uma logo
        }

        // Caso contrário, retorna a URL pública do arquivo
        return Storage::url($this->configData['logo']);
    }     
    
    
}
