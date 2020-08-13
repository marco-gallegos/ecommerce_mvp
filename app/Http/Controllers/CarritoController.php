<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Productos;
use App\Carrito;

class CarritoController extends Controller
{
    public function index(){
        $carritos = Carrito::where('idusuario', Auth::user()->id)->get();
        return view('carrito.index', compact(['carritos']));
    }


    public function agregar($idproducto){
        $producto = Productos::find($idproducto);
        if($producto){
            Carrito::create([
                'idusuario' => Auth::user()->id,
                'idproducto' => $producto->id,
                'cantidad'=>1,
            ]);
        }
        return redirect('/')->with('message', 'se agrego al carrito');
    }
    
    public function eliminar($id){
        $carrito = Carrito::find($id);
        if($carrito){
            $carrito->delete();
        }
        return redirect('/')->with('message', 'se elimino del carrito');
    }
}
