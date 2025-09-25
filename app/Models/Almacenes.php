<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacenes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= ['nombre', 'id_user', 'descripcion', 'slots'];
    public function productos()
    {
        return $this->hasMany(Productos::class, 'almacen', 'id');
    }
}
