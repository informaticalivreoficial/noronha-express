<?php

namespace App\Livewire\Dashboard\Users;

use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{
    use WithFileUploads;

    public $userId;

    public $foto; // Propriedade para armazenar a foto temporariamente
    public $fotoUrl; // Propriedade para armazenar o caminho da foto após o upload
    
    protected $rules = [
        'foto' => 'image|max:1024',
    ];       

    //Informations about
    public $name, $birthday, $gender, $naturalness, $civil_status, $code ,$avatar;    
    
    //Documents
    public $cpf, $rg, $rg_expedition;

    //Address
    public $postcode, $street, $neighborhood, $city, $state, $complement, $number;

    //Contact
    public $phone, $cell_phone, $whatsapp, $email, $additional_email, $telegram;

    //Social
    public $facebook, $instagram, $linkedin;

    //Function
    public $admin = null, $client = null, $editor = null, $superadmin = null;

    public $password;
    public $password_confirmation;

    protected $listeners = ['atualizar-data' => 'atualizarData'];
    
    //$this->userId = null ? 'Novo Cliente' : 'Editar Cliente'

    public function mount($userId = null)
    {
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $this->userId = $user->id;
                $this->name = $user->name;                
                $this->password = $user->password;       
                $this->avatar = $user->avatar;                
                $this->birthday = $user->birthday;
                $this->gender = $user->gender;
                $this->naturalness = $user->naturalness;
                $this->civil_status = $user->civil_status;
                $this->rg = $user->rg;
                $this->rg_expedition = $user->rg_expedition;
                $this->cpf = $user->cpf;
                $this->email = $user->email;
                $this->phone = $user->phone;
                $this->cell_phone = $user->cell_phone;
                $this->whatsapp = $user->whatsapp;
                $this->additional_email = $user->additional_email;
                $this->telegram = $user->telegram;
                $this->number = $user->number;
                $this->postcode = $user->postcode;
                $this->street = $user->street;
                $this->neighborhood = $user->neighborhood;
                $this->city = $user->city;
                $this->state = $user->state;
                $this->complement = $user->complement;
                $this->facebook = $user->facebook;
                $this->instagram = $user->instagram;
                $this->linkedin = $user->linkedin;
                $this->admin = $user->admin;
                $this->superadmin = $user->superadmin;
                $this->editor = $user->editor;
                $this->client = $user->client;
            }            
        }        
    }

    public function render()
    {
        return view('livewire.dashboard.users.form');
    }

    public function save()
    {
        //dd($this->userId);
        if ($this->userId != null) {
            $this->update();
        } else {
            $this->create();
        }
    }

    public function create()
    {
        $validated = app(UserRequest::class)->validated();

        User::create([
            'name' => $validated['name'],                
            'password' => $this->password,       
            'avatar' => $this->avatar,                
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'naturalness' => $this->naturalness,
            'civil_status' => $this->civil_status,
            'rg' => $this->rg,
            'rg_expedition' => $this->rg_expedition,
            'cpf' => $validated['cpf'],
            'email' => $this->email,
            'phone' => $this->phone,
            'cell_phone' => $this->cell_phone,
            'whatsapp' => $this->whatsapp,
            'additional_email' => $this->additional_email,
            'telegram' => $this->telegram,
            'number' => $this->number,
            'postcode' => $this->postcode,
            'street' => $this->street,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,
            'complement' => $this->complement,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'admin' => $this->admin,
            'superadmin' => $this->superadmin,
            'editor' => $this->editor,
            'client' => $this->client
        ]);

        session()->flash('mensagem', 'Usuário cadastrado com sucesso!');
        $this->dispatch(['cliente-cadastrado']);
    }

    public function update()
    {
        $user = User::findOrFail($this->userId); 

        if ($this->foto) {
            // Exclui a foto antiga (se existir)
            if ($this->avatar && Storage::disk()->exists($this->avatar)) {
                Storage::delete($this->avatar);
            }
            // Salva a nova foto no diretório 'public/fotos'
            $caminhoFoto = $this->foto->store('client', 'public');
            $user->update([
                'avatar' => $caminhoFoto
            ]);
        }

        // if ($this->password !== $this->password_confirmation) {
        //     session()->flash('erro', 'As senhas não coincidem!');
        //     return;
        // }
                
        $user->update([            
            'name' => $this->name,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'naturalness' => $this->naturalness,
            'civil_status' => $this->civil_status,
            'rg' => $this->rg,
            'rg_expedition' => $this->rg_expedition,
            'cpf' => $this->cpf,
            'phone' => $this->phone,
            'cell_phone' => $this->cell_phone,
            'additional_email' => $this->additional_email,
            'whatsapp' => $this->whatsapp,
            'number'=> $this->number,
            'postcode' => $this->postcode,
            'street' => $this->street,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,
            'complement' => $this->complement,
            'telegram' => $this->telegram,
            'admin' => $this->admin,
            'superadmin' => $this->superadmin,
            'editor' => $this->editor,
            'client' => $this->client,
        ]);

        //$this->modoEdicao = false;
        //$this->reset(['name', 'email']);
        $this->dispatch('userId');
        $this->dispatch(['cliente-atualizado']);
        $this->reset('foto');        
    }   

    public function updatedPostcode(string $value)
    {
        $this->postcode = preg_replace('/[^0-9]/', '', $value);
        if(strlen($this->postcode) === 8){
            $response = Http::get("https://viacep.com.br/ws/{$this->postcode}/json/")->json();
            if(!isset($response['erro'])){
                $this->street = $response['logradouro'] ?? '';
                $this->neighborhood = $response['bairro'] ?? '';
                $this->state = $response['uf'] ?? '';
                $this->city = $response['localidade'] ?? '';
                $this->complement = $response['complemento'] ?? '';
            }else{
                session()->flash('erro', 'CEP não encontrado!');
            }
        }
    }

    // public function updatedPasswordconfirmation(string $value)
    // {
    //     if ($this->password !== $this->password_confirmation) {
    //         session()->flash('erro', 'As senhas não coincidem!');
    //         return;
    //     }
    // }

    public function updatedFoto()
    {
        $this->validateOnly('foto'); // Valida apenas o campo 'foto'
        $this->fotoUrl = $this->foto->temporaryUrl(); // Gera a URL temporária da foto
    }

    public function atualizarData($valor)
    {
        $this->birthday = $valor;
    }

}
