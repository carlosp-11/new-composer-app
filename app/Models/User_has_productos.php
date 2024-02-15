<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_has_productos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= ['id_user', 'id_productos'];
}
