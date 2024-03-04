<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Moneda extends Model
{
    use HasFactory;

    protected $table = 'currency';

    public $timestamps = false;

    /**
     * Relacion One to Many.
     * Devuelva una colección con todos los clientes que tienen dicha moneda.
     * 
     * @return HasMany
     */
    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'id_moneda', 'id');
    }
}
