<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductosPostRequest;
use App\Productos;


class ProductosController extends Controller
{

    public function catalogo()
    {
        $productos = Productos::all();
        return view('catalogo.index', compact('productos'));
    }

    public function index()
    {
        $productos = Productos::all();
        return view('productos.index', compact('productos'));
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

    // FIXME: agregar movimiento inventario si es que se necesita
    public function store(ProductosPostRequest $request)
    {
        $data = $request->validated();
        $productos = Productos::create($data);
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
    // TODO: eliminar la existencia de edicion
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
