@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">

        <div class="card-header">
            <h1> Productos Edit </h1>
        </div>
        <div class="card-body">

    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li class="text-danger">{{ $error }}</li>
        @endforeach
    </ul>

    @endif

    <form action="{{route('productos.update',['producto'=>$productos->id])}}" method="POST" novalidate>
        @csrf
        @method('PUT')
        

                                        <div class="form-group">
            <label for="nombre">Nombre</label>
                    <input class="form-control String"  type="text"  name="nombre" id="nombre" value="{{old('nombre',$productos->nombre)}}"
                                    required="required"
                        >
                    @if($errors->has('nombre'))
            <p class="text-danger">{{$errors->first('nombre')}}</p>
            @endif
        </div>
                                <div class="form-group">
            <label for="precio">Precio</label>
                    <input class="form-control Float"  type="text"  name="precio" id="precio" value="{{old('precio',$productos->precio)}}"
                                    required="required"
                        >
                    @if($errors->has('precio'))
            <p class="text-danger">{{$errors->first('precio')}}</p>
            @endif
        </div>
                                <div class="form-group">
            <label for="existencia">Existencia</label>
                    <input class="form-control Integer"  type="number"  name="existencia" id="existencia" value="{{old('existencia',$productos->existencia)}}"
                                    required="required"
                        >
                    @if($errors->has('existencia'))
            <p class="text-danger">{{$errors->first('existencia')}}</p>
            @endif
        </div>
                                <div class="form-group">
            <label for="medida">Medida</label>
                    <input class="form-control String"  type="text"  name="medida" id="medida" value="{{old('medida',$productos->medida)}}"
                                    required="required"
                        >
                    @if($errors->has('medida'))
            <p class="text-danger">{{$errors->first('medida')}}</p>
            @endif
        </div>
                                                        <div>
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="{{ url()->previous() }}">Back</a>
        </div>
    </form>
    </div>
        </div>

</div>
@endsection