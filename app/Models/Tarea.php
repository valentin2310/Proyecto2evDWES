<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';
    protected $fillable = [
        'nif',
        'contacto',
        'contacto',
        'telefono',
        'descripcion',
        'correo',
        'direccion',
        'poblacion',
        'id_provincia',
        'cod_postal',
        'estado',
        'id_operario',
        'fecha_realizacion',
        'anotaciones_anteriores',
        'anotaciones_posteriores',
        'fichero',
        'id_cliente'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
    // Lista con los estados que puede tener una tarea
    const OPTIONS_ESTADOS = [
        "P"=> "Pendiente",
        "R"=> "Realizada",
        "C"=> "Cancelada",
    ];
    
    protected function contacto(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }
    protected function poblacion(): Attribute
    {
        return Attribute::make(
            get: function(string $value){
                if($value == null) return 'Ninguna';
                return ucfirst($value);
            },
            set: fn (?string $value) => strtolower($value),
        );
    }
    protected function fechaRealizacion(): Attribute
    {
        return Attribute::make(
            get: function($value){
                if ($value == null) return null;
                return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
            },
            set: function($value){
                if ($value == null) return null;
                return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        );
    }
    protected function nif(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value),
        );
    }

    public function operario(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'id_operario', 'id');
    }
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class, 'id_provincia', 'id');
    }
    public function imagenes(): HasMany
    {
        return $this->hasMany(Imagen::class, 'id_tarea', 'id');
    }

    public function getEstado()
    {
        if (!array_key_exists($this->estado, self::OPTIONS_ESTADOS))
        {
            return 'Estado inválido';
        }
        return self::OPTIONS_ESTADOS[$this->estado];
    }
}
