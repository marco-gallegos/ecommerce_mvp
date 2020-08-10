@extends('layouts.app')
@section('content')
<div class="container">

    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h1> Productos </h1>
        </div>
    <div class="card-body">

    <div>
        <a href="{{route('productos.create')}}">New</a>
    </div>
    <table class="table table-striped">
        @if(count($productos))
        <thead>
            <tr>
                <th>&nbsp;</th>
                                
                                                <td>Nombre</td>
                
                                                <td>Precio</td>
                
                                                <td>Existencia</td>
                
                                                <td>Medida</td>
                
                                
                                
                            </tr>

        </thead>
        @endif
        <tbody>
            @forelse($productos as $productos)
            <tr>
                <td>
                    <a href="{{route('productos.show',['producto'=>$productos] )}}">Show</a>
                    <a href="{{route('productos.edit',['producto'=>$productos] )}}">Edit</a>
                    <a href="javascript:void(0)" onclick="event.preventDefault();
                    document.getElementById('delete-productos-{{$productos->id}}').submit();">
                        Delete
                    </a>
                    <form id="delete-productos-{{$productos->id}}" action="{{route('productos.destroy',['producto'=>$productos])}}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
                    <td>{{$productos->nombre}}</td>
                    <td>{{$productos->precio}}</td>
                    <td>{{$productos->existencia}}</td>
                    <td>{{$productos->medida}}</td>
                                                                                                
            </tr>
            @empty
            <p>No Productos</p>
            @endforelse
        </tbody>
    </table>
    </div>
    </div>

</div>

@endsection