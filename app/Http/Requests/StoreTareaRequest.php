<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use App\Models\Empleado;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreTareaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: Solo tiene que tener permiso los Administradores y los Clientes
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
            'id_cliente' => 'required',
            'id_operario' => 'required_without:v_user',
            'descripcion' => 'required|min:3',
            'contacto' => 'required|min:3',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9', // sólo números, y caracteres de separación (espacio, guión, y otros que estiméis oportuno).
            'cod_postal' => 'nullable|digits:5', // debe tener un formato válido, 5 números.
            'correo' => 'required|email:rfc,filter', // debe tener un formato correcto
            'fecha_realizacion' => 'nullable|date_format:d/m/Y|after:today', // debe tener un formato válido y ser posterior a la fecha actual. Se debe admitir una cadena con el formato d/m/aa.
            'v_cif' => [
                'required_with:v_user',
                function (string $attribute, mixed $value, Closure $fail) {
                    if(!Cliente::where('cif', $value)->where('telefono', $this->input('v_telefono'))->exists()){
                        $fail("Los datos de validación no son correctos");
                    }
                }
            ]
            ,
            'v_telefono' => [
                'nullable',
                'required_with:v_user',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:9',
                
            ]
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                // Comprobar si nif es válido
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
