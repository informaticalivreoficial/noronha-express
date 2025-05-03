<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateManifestItemRequest extends FormRequest
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
            'quantity' => 'nullable|numeric',
            //'unit' => 'nullable|string',
            'description' => 'nullable|string',
            //'horti_fruit' => 'nullable|numeric',
            //'cubage' => 'nullable|numeric',
            //'secure' => 'nullable|numeric',
            //'dry_weight' => 'nullable|numeric',
            //'package' => 'nullable|numeric',
            //'glace' => 'nullable|numeric',
            //'tax' => 'nullable|numeric',
        ];
    }
}
