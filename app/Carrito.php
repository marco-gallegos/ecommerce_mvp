<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';

    /**
     * tipo sera de tipo binarios sobre entendido
     * utilizando 0 para entrada y 1 para salida
     *
     */
    protected $fillable = [
        'idusuario', 'idproducto', 'cantidad',
    ];

    public function Producto()
    {
        return $this->belongsTo('App\Productos', 'idproducto', 'id');
    }
}
