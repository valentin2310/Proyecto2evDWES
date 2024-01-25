<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Expr\Cast\Bool_;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $fillable = [
        'nif',
        'nombre',
        'correo',
        'telefono',
        'direccion',
        'tipo',
        'passwd'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    // Lista con los tipos de usuarios que hay en la aplicación
    const TIPOS_USUARIOS = [
        "ADMIN" => 0,
        "OPERARIO" => 1
    ];

    protected function nif(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtoupper($value),
        );
    }
    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'id_operario', 'id');
    }

    public static function getOperarios()
    {
        return self::where('tipo', Empleado::TIPOS_USUARIOS["OPERARIO"])->get();
    }

    public function esAdmin(): Bool
    {
        return $this->tipo == self::TIPOS_USUARIOS['ADMIN'];
    }

    /**
     * Valida que el nif tenga el formato correcto y que sea válido.
     * @param string $string
     * @return boolean
     */
    public static function nifIsValid($string)
    {
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
