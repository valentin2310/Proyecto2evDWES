<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $table = 'provincias';
    public $timestamps = false;
}
