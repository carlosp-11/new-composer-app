<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Productos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= ['nombre', 'precio', 'descripcion', 'almacen', 'id_user', 'status'];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            $producto->QR = Str::random(10);
        });
    }
}
