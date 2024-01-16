<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    // Lista con los tipos de usuarios que hay en la aplicación
    const TIPOS_USUARIOS = [
        "ADMIN" => 0,
        "OPERARIO" => 1
    ];

    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'id_operario', 'id');
    }

    public static function getOperarios()
    {
        return self::where('tipo', Empleado::TIPOS_USUARIOS["OPERARIO"])->get();
    }
}
