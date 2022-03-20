@extends('online.master')
@section('title','Recuperar Contraseña')
@section('content')
<style>

label{color:#d25959;display:block;font-size:.8em;font-weight:600}
input{border:1px solid #ccc;box-shadow:inset #ccc 0 0 5px;cursor:pointer;font-style:italic;margin:8px 0 20px;padding:7px;width:250px}
.enviar{background:#d25959;box-shadow:none;color:white;margin-bottom:0;width:100px}
.enviar:hover{text-decoration:underline}
/* span{display:block;font-size:.8em;margin:0px 0 10px;padding:5px 0 5px 11px;width:200px} */
.confirmacion{background:#C6FFD5;border:1px solid green;}
.negacion{background:#ffcccc;border:1px solid red}

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 m-5">
            <div class="card">
                <div class="card-header">INGRESE SU NUEVA CONTRASEÑA ...</div>
                <div class="card-body">
                   
                   {!!Form::model($user,['method'=>'PATCH','route'=>['recover_password.update',$user->idpersona], 'id'=>'reset'])!!}
                   {{Form::token()}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contraseña">Contraseña *</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder=""  value="{{ old('password') }}" required>
                                        
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                            </div>
                           <div class="col-md-6 mb-3">
                                <label for="cont">Repita Contraseña * </label>
                                    <input type="password" class="form-control" placeholder="" value="{{ old('password_confirmation') }}" name="password_confirmation" id="password_confirm" required>
                                    
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                            </div>  
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Cambiar contraseña ...
                                </button>
                            </div>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
</div>
@endsection

<script src="../js/jquery-3.2.1.min.js"></script>

<script>
$(document).ready(function() {
	//variables
	var pass1 = $('[name=password]');
	var pass2 = $('[name=password_confirmation]');
	var confirmacion = "Las contraseñas si coinciden";
	var longitud = "La contraseña debe estar formada entre 6-10 carácteres (ambos inclusive)";
	var negacion = "No coinciden las contraseñas";
	var vacio = "La contraseña no puede estar vacía";
	//oculto por defecto el elemento span
	var span = $('<span></span>').insertAfter(pass2);
	span.hide();
	//función que comprueba las dos contraseñas
	function coincidePassword(){
	var valor1 = pass1.val();
	var valor2 = pass2.val();
	//muestro el span
	span.show().removeClass();
	//condiciones dentro de la función
	if(valor1 != valor2){
    span.text(negacion).addClass('negacion');
     $(':input[type="submit"]').prop('disabled', true);	
	}
	if(valor1.length==0 || valor1==""){
    span.text(vacio).addClass('negacion');
     $(':input[type="submit"]').prop('disabled',  true);	
	}
	if(valor1.length<3 || valor1.length>20){
    span.text(longitud).addClass('negacion');
     $(':input[type="submit"]').prop('disabled', true);
	}
	if(valor1.length!=0 && valor1==valor2){
    span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
    $(':input[type="submit"]').prop('disabled', false);
	}
	}
	//ejecuto la función al soltar la tecla
	pass2.keyup(function(){
	coincidePassword();
	});
});

</script>

<script>
$(document).ready(function(){
    $( "#reset" ).submit(function( event ) {
        $('#espere_agregar').removeAttr("style");   
    });
});
</script>