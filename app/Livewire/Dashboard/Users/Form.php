<?php

namespace App\Livewire\Dashboard\Users;

use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class Form extends Component
{
    use WithFileUploads;

    public $userId;

    //Informations about
    public $name, $birthday, $gender, $naturalness, $civil_status, $code ,$avatar;    
    
    //Documents
    public $cpf, $rg, $rg_expedition;

    //Address
    public $postcode, $street, $neighborhood, $city, $state, $complement, $number;

    //Contact
    public $cell_phone, $whatsapp, $email, $additional_email;

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
                $this->birthday = $user->birthday;
                $this->gender = $user->gender;
                $this->naturalness = $user->naturalness;
                $this->civil_status = $user->civil_status;
                $this->rg = $user->rg;
                $this->rg_expedition = $user->rg_expedition;
                $this->cpf = $user->cpf;
                $this->email = $user->email;
                $this->cell_phone = $user->cell_phone;
                $this->whatsapp = $user->whatsapp;
                $this->additional_email = $user->additional_email;
                $this->facebook = $user->facebook;
                $this->instagram = $user->instagram;
                $this->linkedin = $user->linkedin;
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.users.form');
    }

    public function update()
    {
        $user = User::findOrFail($this->userId);

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
            'cell_phone' => $this->cell_phone,
            'whatsapp' => $this->whatsapp,
            'additional_email' => $this->additional_email,
        ]);
        session()->flash('message', 'Cliente atualizado com sucesso!');
        $this->modoEdicao = false;
        //$this->reset(['name', 'email']);
        $this->dispatch('userId');
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

}
