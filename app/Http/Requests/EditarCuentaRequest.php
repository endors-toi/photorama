<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarCuentaRequest extends FormRequest
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
            'nombre' => 'required|min:2|max:50',
            'apellido' => 'required|min:2|max:50',
        ];
    }

    public function messages():array
    {
        return [
            'nombre.required' => 'Indique nombre del usuario',
            'nombre.min' => 'El nombre debe tener entre 2 y 50 caracteres',
            'nombre.max' => 'El nombre debe tener entre 2 y 50 caracteres',
            'apellido.required' => 'Indique apellido del usuario',
            'apellido.min' => 'El apellido debe tener entre 2 y 50 caracteres',
            'apellido.max' => 'El apellido debe tener entre 2 y 50 caracteres',
        ];
    }
}
