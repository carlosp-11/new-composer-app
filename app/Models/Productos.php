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
    protected $fillable= ['nombre', 'precio', 'observaciones', 'categoria'];
    public function almacenes()
    {
        return $this->belongsToMany(Almacenes::class, 'productos_almacenes');
    }
}
