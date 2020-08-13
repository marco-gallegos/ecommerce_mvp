<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductosPostRequest;
use Auth;

use App\Productos;
use App\MovimientosInventario;


class ProductosController extends Controller
{

    public function catalogo()
    {
        $productos = Productos::all();
        return view('catalogo.index', compact(['productos']));
    }

    public function index()
    {
        $productos = Productos::all();
        return view('productos.index', compact(['productos']));
    }

    public function show(Request $request, $productos)
    {   
        $productos = Productos::find($productos);
        return view('productos.show', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }


    public function store(ProductosPostRequest $request)
    {
        $data = $request->validated();
        $productos = Productos::create($data);

        if ($request->existencia > 0) {
            $movimiento = MovimientosInventario::create(
                [
                    'tipo' => 0, #utilizando 0 para entrada y 1 para salida
                    'idproducto' => $productos->id,
                    'idusuario' => Auth::user()->id,
                    'cantidad' => $request->existencia,
                ]
            );
            $productos->existencia += $request->existencia;
            $productos->save();
        }

        return redirect()->route('productos.index')->with('status', 'Productos created!');
    }

    public function edit(Request $request, $productos)
    {
        $productos = Productos::find($productos);
        return view('productos.edit', compact('productos'));
    }


    /**
     * Undocumented function
     *
     * @param ProductosPostRequest $request
     * @param [type] $productos
     * @return void
     */
    public function update(ProductosPostRequest $request, $productos)
    {
        $productos = Productos::find($productos);
        $data = $request->validated();
        $productos->fill($data);
        $productos->save();
        return redirect()->route('productos.index')->with('status', 'Productos updated!');
    }

    public function destroy(Request $request, Productos $productos)
    {
        $productos->delete();
        return redirect()->route('productos.index')->with('status', 'Productos destroyed!');
    }
}
