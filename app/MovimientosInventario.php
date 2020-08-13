<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientosInventario extends Model
{
    protected $table = 'movimientos_inventario';


    /**
     * tipo sera de tipo binarios sobre entendido
     * utilizando 0 para entrada y 1 para salida
     *
     */
    protected $fillable = [
        'tipo', 'idproducto', 'idusuario', 'cantidad',
    ];

    public function Producto()
    {
        return $this->belongsTo('App\Productos', 'idproducto', 'id');
    }
}
