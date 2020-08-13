@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
<script>

axios.get('/api/llave').then(resp=>{
    console.log('hola axios');
    console.log(resp.data.llave);
    //Conekta.setPublicKey("key_JxXxpPyxKKYsMu5wYgr5ncg");
    Conekta.setPublicKey(resp.data.llave);
}
);


var conektaSuccessResponseHandler = function(token){
    var elem = document.querySelector("#conektaTokenId");
    elem.value = token.id;
    document.querySelector("#card-form").submit();
};

var conektaErrorResponseHandler =function(response){
    var $form=document.querySelector("#card-form");
    alert(response.message_to_purchaser);
};

function new_submit(){
    console.log("evento");
    var $form = document.querySelector("#card-form");

    Conekta.Token.create($form,conektaSuccessResponseHandler,conektaErrorResponseHandler);
}

</script>

@if (isset($error))
<div class="container py-3">
    <div class="alert alert-danger" role="alert">
        <strong>{{ $error }}</strong>
    </div>

</div>
@endif

<form id="card-form" class="container" method="post" action="{{ url('pagos/pay') }}">
    @csrf
    <input type="hidden" name="conektaTokenId" id="conektaTokenId" value="" class="form-control">

    <div class="card">
        <div class="card-header">
            <h3>Pagar con tarjeta</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label>
                        Nombre del tarjeta habiente
                    </label>
                    <input value="{{ $user->name }}" data-conekta="card[name]" class="form-control" name="name" id="name"  type="text" >
                </div>
                <div class="col-md-6">
                    <label>
                        Número de tarjeta
                    </label>
                    <input value="4242424242424242" name="card" id="card" data-conekta="card[number]" class="form-control"   type="text" maxlength="16" >
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>
                        CVC
                    </label>
                    <input value="399" data-conekta="card[cvc]" class="form-control"  type="text" maxlength="4" >
                </div>
                <div class="col-md-6">
                        <label>
                            Fecha de expiración (MM/AA)
                        </label>
                        <div>
                            <input style="width:50px; display:inline-block" value="11" data-conekta="card[exp_month]" class="form-control"  type="text" maxlength="2" >
                            <input style="width:50px; display:inline-block" value="20" data-conekta="card[exp_year]" class="form-control"  type="text" maxlength="2" >
                        </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label><span>Email</span></label>
                    <input class="form-control" type="text" name="email" id="email" maxlength="200" value="{{ $user->email }}">
                </div>
                <div class="col-md-4">
                    <label>Concepto</label>
                    <input class="form-control" type="text" name="description" id="description" maxlength="100" value="Venta Marco Shop">
                </div>
                <div class="col-md-4">
                    <label>Monto</label>
                    <input class="form-control" type="number" readonly id="total" value="{{ $data['total'] }}">
                    <input class="form-control" type="hidden" name="total" id="total" value="{{ $data['total'] }}">
                </div>
            </div>
        </div>
    </div>
</form>

<div class="container py-3">
    <div class="row">
        <div class="col-md-12" style="text-align:center;">
            <button class="btn btn-success btn-lg" onclick="new_submit()" >
                <i class="fa fa-check-square"></i> PAGAR
            </button>
        </div>
    </div>
</div>
@endsection