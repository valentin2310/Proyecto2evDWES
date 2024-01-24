<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'cif' => 'required',
            'nombre' => 'required|min:3',
            'correo' => 'email:rfc,filter',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'passwd' => 'required|min:3|same:passwd_2',
            'passwd_2' => 'required|min:3',
            'cuenta_corriente' => 'required',
            'cuota_mensual' => 'nullable|numeric'
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->input('cif') && !Cliente::cifIsValid($this->input('cif'))) {
                    $validator->errors()->add(
                        'cif',
                        'El CIF no es válido.'
                    );
                }
            }
        ];
    }
}
