<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos_has_categorias extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= ['id_producto','id_categoria' , 'status', 'descripcion'];
}
