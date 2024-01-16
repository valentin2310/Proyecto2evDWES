<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $casts = [
        'fecha_creacion' => 'datetime:d/m/Y',
        'fecha_actualizacion' => 'datetime:d/m/Y',
        'fecha_realizacion' => 'datetime:d/m/Y',
    ];

     // Lista con los estados que puede tener una tarea
    const OPTIONS_ESTADOS = [
        "P"=> "Pendiente",
        "R"=> "Realizada",
        "C"=> "Cancelada",
    ];

    /**
     * Prepare a date for array / JSON serialization.
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d/m/Y');
    }

    public function operario(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'id_operario', 'id');
    }
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
    public function imagenes(): HasMany
    {
        return $this->hasMany(Imagen::class, 'id_tarea', 'id');
    }

    public function getEstado()
    {
        return self::OPTIONS_ESTADOS[$this->estado];
    }
}
