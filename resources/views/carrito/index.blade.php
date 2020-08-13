@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h2>Carrito de Compras</h2>
    </div>
    <div class="row">
        <div class="col-12">
            <a href='{{ url("pagos") }}' class="btn btn-info" >Comprar</a>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>Eliminar de carrito</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carritos as $movimiento)
                    <tr>
                        <td>{{ $movimiento->Producto->nombre }}</td>
                        <td>{{ $movimiento->cantidad }}</td>
                        <td>{{ $movimiento->created_at }}</td>
                        <td>
                            <a href='{{ url("carrito/eliminar/{$movimiento->id}") }}' class="btn btn-danger" onclick="return confirm('seguro que quiere eliminar esto de su carrito')" >Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection