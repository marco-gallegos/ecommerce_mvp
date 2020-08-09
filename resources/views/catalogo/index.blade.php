@extends('layouts.app')

@section('content')
    <div class="container">
    <a href='{{  url('productos/create') }}' class="btn btn-info" >Crear</a>
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-md-2">
                    <div class="card text-left">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <p class="card-text">Body</p>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection