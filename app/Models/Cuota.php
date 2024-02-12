<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cuota extends Model
{
    use HasFactory;

    protected $table = 'cuotas';

    protected $fillable = [
        'concepto',
        'fecha_pago',
        'importe',
        'pagada',
        'id_cliente',
        'id_tarea',
        'notas'
    ];

    const CREATED_AT = 'fecha_emision';
    const UPDATED_AT = 'fecha_actualizacion';

    protected function fechaPago(): Attribute
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
    protected function importe(): Attribute
    {
        return Attribute::make(
            get: function($value){
                return round((currency_value($this->cliente->moneda->code) * $value), 2);
            }
        );
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
    public function tarea(): BelongsTo
    {
        return $this->belongsTo(Tarea::class, 'id_tarea', 'id');
    }

    public static function addCuotaMensual(Cliente $cliente)
    {
        $cuota = new Cuota();

        $cuota->id_cliente = $cliente->id;
        $cuota->concepto = 'Cuota mensual';
        $cuota->importe = $cliente->cuota_mensual;

        $cuota->save();
    }
    public static function addRemesaMensual()
    {
        $lista = Cliente::all();

        foreach ($lista as $cli) {
            self::addCuotaMensual($cli);
        }
    }
}
