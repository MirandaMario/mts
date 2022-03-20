@extends('online.master')
@section('title','INGRESAR')
@section('content')
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">LOGIN CLIENTE</div>
                <div class="card-body">
                    <form method="POST" id="ingresar">
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
                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Recordar usuario y contraseña en este equipo 
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    INGRESAR
                                </button>

                                <a class="btn btn-link" href="{{url('recover_password')}}">
                                   olvide mi contraseña
                                </a>
                            </div>
                        </div>
                    </form>
                    <div>
                        <label class="form-check-label" >
                           <b> No esta registrado, registrado ??? </b>
                        </label>
                        <a href='./registrarse' >&nbsp;&nbsp;REGISTRATE ACA</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script>
$(document).ready(function(){
    $( "#ingresar" ).submit(function( event ) {
        $('#espere_agregar').removeAttr("style");   
    });
});  
</script>