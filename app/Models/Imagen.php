<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'img';
    public $timestamps = false;

     /**
     * Relacion Many to One.
     * Devuelve la tarea a la que pertenece.
     * 
     * @return BelongsTo
     */
    public function tarea(): BelongsTo
    {
        return $this->belongsTo(Tarea::class, 'id_tarea', 'id');
    }
}
