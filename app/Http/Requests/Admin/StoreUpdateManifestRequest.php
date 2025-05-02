<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\StatusOfManifestEnum;

class StoreUpdateManifestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:fisica,juridica',
            'trip' => 'required|exists:trips,id',  
            'user' => 'required_if:type,fisica',
            'company' => 'required_if:type,juridica',
            'status' => ['required', new Enum(StatusOfManifestEnum::class)],
            'zipcode' => 'required|string|max:10',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'neighborhood' => 'required|string|max:255',        
            'contact' => 'nullable|string|min:3',
            'information' => 'nullable|string|min:3|max:255',
        ];
    }
}
