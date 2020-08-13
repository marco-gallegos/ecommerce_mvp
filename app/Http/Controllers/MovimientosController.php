<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\MovimientosInventario;
use App\Productos;

class MovimientosController extends Controller
{
    public function index(){
        $movimientos = MovimientosInventario::orderBy('created_at','desc')->paginate(50);
        return view('movimientos.index', compact(['movimientos']));
    }
    
    public function create(){
        $productos = Productos::all();
        return view('movimientos.create', compact('productos'));
    }
    
    public function store(Request $request){
        //dd($request->all());
        $producto = Productos::find($request->idproducto);

        if($producto){
            $movimiento = MovimientosInventario::create(
                [
                    'tipo' => $request->tipo, #utilizando 0 para entrada y 1 para salida
                    'idproducto' => $producto->id,
                    'idusuario' => Auth::user()->id,
                    'cantidad' => $request->cantidad,
                ]
            );
            $producto->existencia += $request->cantidad;
            $producto->save();
        }else{
            dd("no jalo");
        }
        return redirect('productos');
    }
}
