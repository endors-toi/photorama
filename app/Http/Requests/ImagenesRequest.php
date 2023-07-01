<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImagenesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
                'titulo' => 'required|string|max:20',
                'archivo' => 'required|image|max:2048', // Se valida como una imagen
                'baneada' => 'boolean',
                'motivo_ban' => 'nullable|string',
                'cuenta_user' => 'required|string|max:20'
            
        ];
    }
}
