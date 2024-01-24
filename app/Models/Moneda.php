<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Moneda extends Model
{
    use HasFactory;

    protected $table = 'currency';

    public $timestamps = false;

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'id_moneda', 'id');
    }
}
