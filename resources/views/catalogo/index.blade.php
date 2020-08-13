@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-md-6 col-lg-3 py-2" >
                    <div class="card text-left" >
                        <img class="card-img-top" alt="no imagen" height="100" >
                        <div class="card-body">
                            <h4 class="card-title">{{ $producto->nombre }}</h4>
                            <p class="card-text">
                                <div class="container-fluid">
                                    <div class="row">
                                        Costo : $ {{ $producto->precio }} MXN
                                    </div>
                                    <div class="row">
                                        Existencia : {{ $producto->existencia }}
                                    </div>

                                    @guest
                                        <div class="row py-1">
                                            <a href='{{ url("login") }}' class="btn btn-warning btn-sm" >Accede para Comprar</a>
                                        </div>

                                    @else
                                        <div class="row py-1">
                                            <a href='{{ url("carrito/agregar/{$producto->id}") }}' class="btn btn-info btn-sm" >Agregar al carrito</a>
                                        </div>
                                    @endguest
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection