<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\ProductosPostRequest;
use App\Http\Controllers\Controller;
use App\Productos;

class ProductosController extends Controller
{


    public function index()
    {
        return Productos::all();
    }

    public function show(Request $request, Productos $productos)
    {
        return $productos;
    }

    public function store(ProductosPostRequest $request)
    {
        $data = $request->validated();
        $productos = Productos::create($data);
        return $productos;
    }

    public function update(ProductosPostRequest $request, Productos $productos)
    {
        $data = $request->validated();
        $productos->fill($data);
        $productos->save();

        return $productos;
    }

    public function destroy(Request $request, Productos $productos)
    {
        $productos->delete();
        return $productos;
    }

}
