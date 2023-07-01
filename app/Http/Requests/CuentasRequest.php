<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CuentasRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user'=>'required|unique:cuentas,user',
            'nombre' => 'required|min:2|max:50',
            'password' => 'bail|required|min:6|max:20|same:password2',
        ];
    }

    public function messages():array
    {
        return [
            'user.required' => 'Indique el nick del usuario',
            'nombre.unique' => 'El nick del usuario debe ser unico',
            'nombre.required' => 'Indique nombre del usuario',
            'nombre.min' => 'El nombre debe tener entre 2 y 50 caracteres',
            'nombre.max' => 'El nombre debe tener entre 2 y 50 caracteres',
            'password.required' => 'Indique contraseña del usuario',
            'password.min' => 'La contraseña debe tener entre 6 y 20 caracteres',
            'password.max' => 'La contraseña debe tener entre 6 y 20 caracteres',
            'password.same' => 'Las contraseñas no coinciden',
        ];
    }
}
