<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Productos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= ['nombre', 'precio', 'observaciones', 'almacen', 'id_user'];
    
}
