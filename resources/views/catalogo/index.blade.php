@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-md-2">
                    <div class="card text-left">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{ $producto->nombre }}</h4>
                        <p class="card-text">
                            <div class="container-fluid">
                                <div class="row">
                                    Costo : $ {{ $producto->precio }}
                                </div>
                                <div class="row">
                                    Existencia : {{ $producto->existencia }}
                                </div>
                            </div>
                        </p>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection