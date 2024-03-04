<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */
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
    // Campos que permitimos que sean rellenables a través de un formulario.
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

     /**
     * Atributo que devuelve la fecha en diferentes formatos.
     * La muestra como d/m/Y y la inserta como Y-m-d
     * 
     * @return Attribute
     */
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
    /**
     * Atributo que devuelve el importe con el valor de la moneda del cliente.
     * Hace uso del helper currency_value.
     * 
     * @return number
     */
    public function importeCurrency()
    {
        return round((currency_value($this->cliente->moneda->code) * $this->importe), 2);
    }
    /**
     * Relacion Many to One.
     * Devuelve el cliente que posee dicha cuota.
     * 
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
    /**
     * Relacion Many to One.
     * Devuelve la tarea de la cual se efectúa dicha cuota.
     * 
     * @return BelongsTo
     */
    public function tarea(): BelongsTo
    {
        return $this->belongsTo(Tarea::class, 'id_tarea', 'id');
    }
    /**
     * Crea una cuota con los datos del cliente.
     * 
     * @param Cliente $cliente
     * @return void
     */
    public static function addCuotaMensual(Cliente $cliente)
    {
        $cuota = new Cuota();

        $cuota->id_cliente = $cliente->id;
        $cuota->concepto = 'Cuota mensual';
        $cuota->importe = $cliente->cuota_mensual;

        $cuota->save();
    }
    /**
     * Hace uso de la función addCuotaMensual para crear una cuota para cada cliente.
     * 
     * @return void
     */
    public static function addRemesaMensual()
    {
        $lista = Cliente::all();

        foreach ($lista as $cli) {
            self::addCuotaMensual($cli);
        }
    }
    /**
     * Actualiza el estado de la cuota a pagada.
     * 
     * @return void
     */
    public function pagar(){
        $this->update([
            'pagada' => true,
            'fecha_pago' => Carbon::now()->format('d/m/Y')
        ]);
    }
}
