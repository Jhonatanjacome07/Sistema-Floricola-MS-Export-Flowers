<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdministradorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        'name' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email|unique:users',  // Ejemplo de validación adicional para email
        'password' => 'required|string|min:8',  // Ejemplo de validación adicional para password
        'cedula' => 'required|string|unique:users',  // Ejemplo de validación adicional para cedula
        'phone' => 'required|string',
        ];
    }
}
