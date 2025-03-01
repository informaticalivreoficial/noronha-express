<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //'Type' => 'required|array',
            'name' => 'required|min:3|max:191',
            //'nasc' => 'required|date_format:d/m/Y',
            //'genero' => 'required|in:masculino,feminino',
            //'estado_civil' => 'required|in:casado,separado,solteiro,divorciado,viuvo',
            'cpf' => 'required|cpf|unique:users,cpf,' . $this->route('id'),
            //'rg' => 'required_if:client,on|min:8|max:12',
            //'rg' => 'required|min:8|max:12',
            //'rg_expedicao' => 'required',
            //'naturalidade' => 'required_if:client,on',
            //'avatar' => 'image',
            
            // Address
            // 'cep' => 'required|min:8|max:9',
            // 'rua' => 'required',
            // 'num' => 'required',
            // 'bairro' => 'required',
            // 'uf' => 'required',
            // 'cidade' => 'required',
            
            // Access
            'email' => (!empty($this->request->all()['id']) ? 'required|email|unique:users,email,' . $this->request->all()['id'] : 'required|email|unique:users,email'),
            //'password' => (empty($this->request->all()['id']) ? 'required' : ''),
            
            // Contact
            //'celular' => 'required',
                        
            // Spouse
            //'tipo_de_comunhao' => 'required_if:estado_civil,casado|in:universal,parcial,total,final',
            //'nome_conjuje' => 'required_if:estado_civil,casado|min:3|max:191',
            //'genero_conjuje' => 'required_if:estado_civil,casado|in:masculino,feminino',
//            'cpf_conjuje' => 'required_if:estado_civil,casado,separado|min:11|max:14',
//            'rg_conjuje' => 'required_if:estado_civil,casado,separado|min:8|max:12',
//            'rg_expedicao_conjuje' => 'required_if:estado_civil,casado,separado',
            //'nasc_conjuje' => 'required_if:estado_civil,casado|date_format:d/m/Y',
//            'naturalidade_conjuje' => 'required_if:estado_civil,casado,separado',
//            'profissao_conjuje' => 'required_if:estado_civil,casado,separado',
//            'renda_conjuje' => 'required_if:estado_civil,casado,separado',
//            'profissao_empresa_conjuje' => 'required_if:estado_civil,casado,separado'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório!',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres!',
            'cpf.required' => 'O cpf é obrigatório!',
            'email.required' => 'O e-mail é obrigatório!',
            'email.email' => 'O e-mail deve ser válido!',
            'email.unique' => 'Este e-mail já está cadastrado!',
            'password.required' => 'A senha é obrigatória!',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres!',
            'password.confirmed' => 'As senhas não coincidem!',
            'estado_civil.required' => 'O estado civil é obrigatório!',
            'estado_civil.in' => 'Selecione um estado civil válido!',
        ];
    }
}
