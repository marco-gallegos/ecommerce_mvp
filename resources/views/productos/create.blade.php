@extends('layouts.app')

@section('content')
    <div class="container">
    <a href='{{  url('productos') }}' class="btn btn-default" >Listado</a>
        <div class="row">
            <div class="col-12">
                <form action="post">
                    @csrf
                    <div class="col-6">
                        <label for="">Nombre</label>
                    </div>
                    <div class="col-6">
                        <label for="">Precio</label>
                    </div>
                    <div class="col-6">
                        <label for="">Nombre</label>
                    </div>
                    <div class="col-6">
                        <label for="">Nombre</label>
                    </div>
                    <div class="col-6">
                        <label for="">Nombre</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection