<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory;
    //public $timestamps = false;
     
    protected $fillable = ['status', 'id_producto', 'descripcion']; 
    
    const ESTADO_EN_STOCK = 'en stock';
    const ESTADO_DESPACHADO = 'despachado';
    const ESTADO_EN_TRANSITO = 'en transito';
    const ESTADO_CON_INCIDENCIA = 'con incidencia';

    protected $attributes = [
        'status' => self::ESTADO_EN_STOCK, // Valor por defecto
    ];

    // Método de acceso para obtener el estado en formato legible
    public function getEstadoAttribute($value)
    {
        switch ($value) {
            case self::ESTADO_EN_STOCK:
                return 'En stock';
            case self::ESTADO_DESPACHADO:
                return 'Despachado';
            case self::ESTADO_EN_TRANSITO:
                return 'En tránsito';
            case self::ESTADO_CON_INCIDENCIA:
                return 'Con incidencia';
            default:
                return $value;
        }
    }
}
