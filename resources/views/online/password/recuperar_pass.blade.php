@extends('online.master')
@section('title','Recuperar Contraseña')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 m-5">
            <div class="card">
                <div class="card-header">Ingrese email con el que registro su cuenta ...</div>
                <div class="card-body">
                    <form method="POST" id="recuperar">
                        @csrf
                        <div class="form-group row">
                            <label for="email"
                                class="col-sm-4 col-form-label text-md-right">E-Mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Recuperar contraseña ...
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

@endsection
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script>
$(document).ready(function(){
    $( "#recuperar" ).submit(function( event ) {
        $('#espere_agregar').removeAttr("style");   
    });
});
</script>

