<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    public function cuotas(): HasMany
    {
        return $this->hasMany(Cuota::class, 'id_cliente', 'id');
    }
    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'id_cliente', 'id');
    }
}
