<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';
    // Campos que permitimos que sean rellenables a través de un formulario.
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
    // Lista con los campos que puede tener una tarea
    const OPTIONS_CAMPOS = [
        'id' => 'ID',
        'nif' => 'NIF',
        'contacto' => 'Contacto',
        'operario' => 'Operario',
        'telefono' => 'Teléfono',
        'descripcion' => 'Descripción',
        'correo' => 'Correo',
        'estado' => 'Estado',
        'fecha_realizacion' => 'Fecha realización',
    ];

    // Lista de criterios por los que se puede buscar una tarea
    const OPTIONS_CRITERIOS = [
        'like' => 'Igual',
        'not like' => 'No igual',
        '>' => 'Mayor que',
        '<' => 'Menor que',
        '>=' => 'Mayor o igual que',
        '<=' => 'Menor o igual que',
    ];
     /**
     * Atributo que devuelve el nombre del contacto con la primera letra en mayúscula.
     * Guarda en la bd el contacto en minúsculas.
     * 
     * @return Attribute
     */
    protected function contacto(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }
     /**
     * Atributo que devuelve la población con la primera letra en mayúscula.
     * Guarda en la bd la poblacion en minúsculas.
     * 
     * @return Attribute
     */
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
     /**
     * Atributo que devuelve la fecha en diferentes formatos.
     * La muestra como d/m/Y y la inserta como Y-m-d
     * 
     * @return Attribute
     */
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
    /**
     * Atributo que devuelve el nif en mayúsculas
     * 
     * @return Attribute
     */
    protected function nif(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value),
        );
    }
    /**
     * Relacion Many to One.
     * Devuelve la el operario que tiene asignado.
     * 
     * @return BelongsTo
     */
    public function operario(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'id_operario', 'id');
    }
    /**
     * Relacion Many to One.
     * Devuelve la el cliente al que pertenece dicha tarea.
     * 
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
    /**
     * Relacion Many to One.
     * Devuelve la provinia que tiene.
     * 
     * @return BelongsTo
     */
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class, 'id_provincia', 'id');
    }
     /**
     * Relacion One to Many.
     * Devuelva una colección con todas sus imágenes.
     * 
     * @return HasMany
     */
    public function imagenes(): HasMany
    {
        return $this->hasMany(Imagen::class, 'id_tarea', 'id');
    }
    /**
     * Devuelve el estado de la tarea.
     * 
     * @return string
     */
    public function getEstado()
    {
        if (!array_key_exists($this->estado, self::OPTIONS_ESTADOS))
        {
            return 'Estado inválido';
        }
        return self::OPTIONS_ESTADOS[$this->estado];
    }
    /**
     * Guarda en storage el fichero de la tarea.
     * 
     * @param Request $request
     * @return void
     */
    public function guardarFichero($request)
    {
        if(!$request->hasFile('fichero')) return;

        $fichero = $request->file('fichero');
        $nombreFichero = $fichero->getClientOriginalName();
        $fichero->storeAs("tareas/$this->id/ficheros_tarea", $nombreFichero, "public");

        $this->fichero = "tareas/$this->id/ficheros_tarea/$nombreFichero";
    }
    /**
     * Guarda las imagenes de la tarea en storage.
     * También las guarda en la bd.
     * 
     * @param Request $request
     * @return void
     */
    public function guardarImagenes($request)
    {
        if(!$request->hasFile('fotos')) return;

        foreach($request->file('fotos') as $foto){
            $nombreFoto = $foto->getClientOriginalName();
            $foto->storeAs("tareas/$this->id/fotos_tarea", $nombreFoto, "public");

            $img = new Imagen();
            $img->id_tarea = $this->id;
            $img->path = "tareas/$this->id/fotos_tarea/$nombreFoto";

            $img->save();
        }
    }
    /**
     * Elimina todos los archivos de la tarea en storage.
     * 
     * @return void
     */
    public function eliminarArchivos()
    {
        // Elimina la carpeta de la tarea en storage
        $rutaDirectorio = "public/tareas/$this->id";
        if(Storage::directoryExists($rutaDirectorio)){
            Storage::deleteDirectory($rutaDirectorio);
        }
    }
}
