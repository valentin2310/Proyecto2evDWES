<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    public $timestamps = false;
    /**
     * Relacion One to Many.
     * Devuelva una colección con los clientes que tienen ese país.
     * 
     * @return HasMany
     */
    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'id_pais', 'id');
    }
    
}
