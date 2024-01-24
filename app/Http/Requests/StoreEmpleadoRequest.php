<?php

namespace App\Http\Requests;

use App\Models\Empleado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreEmpleadoRequest extends FormRequest
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
            'nif' => 'required',
            'nombre' => 'required|min:3',
            'correo' => 'required|email:rfc,filter|unique:empleados,correo', 
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9', 
            'tipo' => 'required|regex:/^[01]{1}$/',
            'passwd' => 'required|min:3|same:passwd_2',
            'passwd_2' => 'required|min:3'
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->input('nif') && !Empleado::nifIsValid($this->input('nif'))) {
                    $validator->errors()->add(
                        'nif',
                        'El NIF no es válido.'
                    );
                }
            }
        ];
    }
}