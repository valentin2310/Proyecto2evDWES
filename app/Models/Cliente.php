<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
        'cif',
        'nombre',
        'telefono',
        'correo',
        'passwd',
        'cuenta_corriente',
        'id_pais',
        'id_moneda',
        'cuota_mensual'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected function cif(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtoupper($value),
        );
    }
    protected function cuentaCorriente(): Attribute
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

    public function cuotas(): HasMany
    {
        return $this->hasMany(Cuota::class, 'id_cliente', 'id');
    }
    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'id_cliente', 'id');
    }
    public function moneda(): BelongsTo
    {
        return $this->belongsTo(Moneda::class, 'id_moneda', 'id');
    }
    public function pais(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'id_pais', 'id');
    }

    public static function cifIsValid($string)
    {
        // Tipos de organización
        $tipos = "ABCDEFGHKLMNPQS";
        $digitosControl = "JABCDEFGHI";

        // Patrón que tiene que tener el cif
        $patron = "/^[$tipos]{1}[0-9]{7}[A-Z0-9]{1}$/";

        // Convierte el cif a mayúsculas
        $cif = strtoupper($string);

        // Comprueba que tenga formato válido
        if(!preg_match($patron, $cif)) return false;

        $cifNumeros = substr($cif, 1, strlen($cif)-2);

        // Calculamos a = suma de los números pares
        $a = 0;

        for($n = 1; $n < strlen($cifNumeros); $n+=2){
            $a += intval($cifNumeros[$n]);
        }

        // Calculamos b = impares * 2 -> suma de sus cifras -> suma de todos los resultados
        $b = 0;

        for($n = 0; $n < strlen($cifNumeros); $n+=2){
            $aux = intval($cifNumeros[$n]) * 2;
            
            if(strlen($aux) > 1){
                $arr = str_split($aux);
                $b += $arr[0] + $arr[1];
            }else{
                $b += $aux;
            }
        }

        // Suma parcial C = A + B
        $c = ($a + $b)%10;

        // Lo restamos a 10
        $d = 10 - $c;

        // Comprobamos digito de control
        $dig_control = substr($cif, 8, 1);
        if($dig_control != $d && $dig_control != $digitosControl[$d]) return false;

        return true;
    }
}
