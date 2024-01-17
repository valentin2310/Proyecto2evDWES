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
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }
    protected function fechaRealizacion(): Attribute
    {
        return Attribute::make(
            get: function($value){
                return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
            },
            set: function($value){
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
    public function asignarValores(Request $request)
    {
        $this->id = $request->id ?? null;
        $this->nif = $request->nif ?? null;
        $this->contacto = $request->contacto ?? null;
        $this->telefono = $request->telefono ?? null;
        $this->descripcion = $request->descripcion ?? null;
        $this->correo = $request->correo ?? null;
        $this->direccion = $request->direccion ?? null;
        $this->poblacion = $request->poblacion ?? null;
        $this->id_provincia = $request->id_provincia ?? null;
        $this->cod_postal = $request->cod_postal ?? null;
        $this->estado = $request->estado ?? null;
        $this->id_operario = $request->id_operario ?? null;
        $this->id_cliente = $request->id_cliente ?? null;
        $this->fecha_creacion = $request->fecha_creacion ?? null;
        $this->fecha_realizacion = $request->fecha_realizacion ?? null;
        $this->anotaciones_anteriores = $request->anotaciones_anteriores ?? null;
        $this->anotaciones_posteriores = $request->anotaciones_posteriores ?? null;
        $this->fichero = $request->fichero ?? null;
    }
}
