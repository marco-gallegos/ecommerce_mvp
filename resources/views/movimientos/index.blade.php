@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h2>Log de movimientos</h2>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movimientos as $movimiento)
                    <tr>
                        <td scope="row">{{ ($movimiento->tipo == 0)? "Entrada":"Salida" }}</td>
                        <td>{{ $movimiento->created_at }}</td>
                        <td>{{ $movimiento->Producto->nombre }}</td>
                        <td>{{ $movimiento->cantidad }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection