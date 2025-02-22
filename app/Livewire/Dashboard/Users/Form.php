<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
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

    public $modoEdicao = false;

    

    public function mount($userId = null)
    {
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $this->userId = $user->id;
                $this->name = $user->name;                
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
                $this->facebook = $user->facebook;
                $this->instagram = $user->instagram;
                $this->linkedin = $user->linkedin;
                $this->admin = $user->admin;
                $this->superadmin = $user->superadmin;
                $this->editor = $user->editor;
                $this->client = $user->client;
            }            
        }
        //$this->fotoUrl = $this->foto->temporaryUrl(); // Gera a URL temporária da foto
    }

    public function render()
    {
        return view('livewire.dashboard.users.form');
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
        
        //$this->fotoUrl = $this->foto->store('client', 'public');
        
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

   
    // Função para fazer a consulta via API
    public function consultarCep()
    {
        // Validando se o CEP foi informado corretamente
        if (strlen($this->cep) === 8) {
            $response = Http::get("https://viacep.com.br/ws/{$this->cep}/json/");
            
            if ($response->ok()) {
                $data = $response->json();
                dd($data);
                // Preenche os campos com os dados retornados da consulta
                $this->endereco = $data['logradouro'] ?? '';
                $this->bairro = $data['bairro'] ?? '';
                $this->cidade = $data['localidade'] ?? '';
                $this->estado = $data['uf'] ?? '';
            } else {
                // Em caso de erro, limpa os campos
                $this->endereco = '';
                $this->bairro = '';
                $this->cidade = '';
                $this->estado = '';
                session()->flash('error', 'CEP não encontrado.');
            }
        }
    }

    public function updatedFoto()
    {
        $this->validateOnly('foto'); // Valida apenas o campo 'foto'
        $this->fotoUrl = $this->foto->temporaryUrl(); // Gera a URL temporária da foto
    }

}
