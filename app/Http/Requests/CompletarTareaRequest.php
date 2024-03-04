<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CompletarTareaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aplica las reglas de validación que va a aplicar sobre la request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fecha_realizacion' => 'nullable|date_format:d/m/Y|after:today',
        ];
    }
}
