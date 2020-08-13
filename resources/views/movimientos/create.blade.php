@extends('layouts.app')

@section('content')
<div class="container">
    <form action='{{ route("movimiento.store") }}' method="post" class="row" >
        @csrf
        <div class="col-12">
            <label for="">Tipo</label>
            <select name="tipo" id="" class="form-control">
                <option value="0" selected >Entrada</option>
            </select>
        </div>
        
        <div class="col-12">
            <label for="">Producto</label>
            <select name="idproducto" id="" class="form-control">
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" >{{ "{$producto->nombre} | {$producto->existencia}" }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-12">
            <label for="">Cantidad</label>
            <input type="number" min="1" name="cantidad" value="1" class="form-control">
        </div>

        <div class="col-12 py-3">
            <button type="submit" class="btn btn-success">Crear</button>
        </div>
    </form>
</div>
@endsection