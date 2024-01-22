<?php

namespace App\Http\Requests;

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
            'id_operario' => 'required',
            'descripcion' => 'required|min:3',
            'contacto' => 'required|min:3',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9', // sólo números, y caracteres de separación (espacio, guión, y otros que estiméis oportuno).
            'cod_postal' => 'nullable|digits:5', // debe tener un formato válido, 5 números.
            'correo' => 'required|email:rfc,filter', // debe tener un formato correcto
            'fecha_realizacion' => 'nullable|date_format:d/m/Y|after:today', // debe tener un formato válido y ser posterior a la fecha actual. Se debe admitir una cadena con el formato d/m/aa.
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->input('nif') && !$this->nifIsValid($this->input('nif'))) {
                    $validator->errors()->add(
                        'nif',
                        'El NIF no es válido.'
                    );
                }
            }
        ];
    }

    /**
     * Valida que el nif tenga el formato correcto y que sea válido.
     * @param string $string
     * @return boolean
     */
    public function nifIsValid($string){
        // Tiene que tener un formato válido, formato español
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letrasNIE = "XYZ";
        // El patrong que tiene que tener el nif
        $patron = "/^([XYZ]|[0-9]){1}[0-9]{7}[A-Z]{1}$/";

        // Convierte el nif a mayúsculas
        $nif = strtoupper($string);

        // Comprueba que tenga el formato correcto
        if(preg_match($patron, $nif)){
            $nifSinLetra = substr($nif, 0, strlen($nif)-1);

            // Si el nif tiene xyz al inicio sustituirlo por su correspondiente valor numérico
            if(preg_match("/[XYZ]+/", $nifSinLetra)){
                for($i = 0; $i < strlen($letrasNIE); $i++){
                    if($nifSinLetra[0] == $letrasNIE[$i]){
                        $nifSinLetra = $i . substr($nifSinLetra, 1);
                    }
                }
            }

            // Obtiene la letra del nif
            $resto = intval($nifSinLetra)%23;
            $letra = $letras[$resto];

            // Comprueba si la letra del nif es válida
            if($nif[8] != $letra){
                return false;
            }

        }else{
            return false;
        }

        return true;
    }
}
