<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorias extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= ['nombre', 'descripcion', 'id_user'];
    public function categoria_has_productos(): HasMany{
        return $this->hasMany(Productos::class);
    }

}

// usar un get para obtener la categoria. Ejemplo: $user->posts()->where('active', 1)->get();
