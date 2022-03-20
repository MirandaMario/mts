@extends('online.master')
@section('title','REGISTRO')
@section('content')
<link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<style>
    /* label{color:#d25959;display:block;font-size:.8em;font-weight:600} */
    /*     input{border:1px solid #ccc;box-shadow:inset #ccc 0 0 5px;cursor:pointer;font-style:italic;margin:8px 0 20px;padding:7px;width:250px} */
    /*  .enviar{background:#d25959;box-shadow:none;color:white;margin-bottom:0;width:100px}
    .enviar:hover{text-decoration:underline} */
    /* span{display:block;font-size:.8em;margin:0px 0 10px;padding:5px 0 5px 11px;width:200px} */
    .confirmacion {
        background: #C6FFD5;
        border: 1px solid green;
    }

    .negacion {
        background: #ffcccc;
        border: 1px solid red
    }
</style>
<!-- SECTION -->
<br>
<div class="section">
    <!-- container -->
    <div class="container">
        <div class="title-left col-sm-12 col-lg-12">
            <h3>Crear cuenta </h3>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-sm-6 col-lg-6 mb-3">

                {!!Form::open(array('url'=>'sol_reg','method'=>'POST','autocomplete'=>'off', 'id'=>'registrarse'))!!}

                <form class="needs-validation" novalidate>

                    <div class="mb-3">
                        <label for="nombre">Nombre Completo *</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nombre" placeholder=""
                                title="Solo letras. Tamaño mínimo: 4 Tamaño" value="{{ old('nombre') }}" required>
                        </div>

                        @if ($errors->has('nombre'))
                        <span class="text-danger">{{ $errors->first('nombre') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-12 mb-3">
                            <label for="dui">Tel. (Sin guión) *</label>
                            <input type="number" class="form-control" name="tel" placeholder="" value="{{ old('tel') }}"
                                title="Solo números" required>


                            @if ($errors->has('tel'))
                            <span class="text-danger">{{ $errors->first('tel') }}</span>
                            @endif
                        </div>
                        <div class="col-md-12 mb-12 mb-3">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" name="email" placeholder=""
                                value="{{old('email')}}">

                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contraseña">Contraseña *</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder=""
                                value="{{ old('password') }}" required>

                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cont">Repita Contraseña * </label>
                            <input type="password" class="form-control" placeholder=""
                                value="{{ old('password_confirmation') }}" name="password_confirmation"
                                id="password_confirm" required>

                            @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
            </div>

            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="mb-3">
                    <label for="direccion">Dirección *</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="direccion" placeholder=""
                            value="{{ old('direccion') }}" required>

                    </div>
                    @if ($errors->has('direccion'))
                    <span class="text-danger">{{ $errors->first('direccion') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="departamento">Departamento</label>
                        <select class="form-control" id="departamento" name="departamento" {{-- class="input2"  --}}>
                            <option value=""></option>
                            @foreach($departamentos as $dep)
                            <option value="{{$dep->ID}}">{{$dep->DepName}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="municipio">Municipio</label>
                        <select class="form-control" name="id_municipio" id="id_municipio">
                            <option value="214">San Salvador</option>
                        </select>
                    </div>
                </div>
<br>
                <div class="input-checkbox mt-10">
                    <input type="checkbox" id="terms" name="terms">
                    <label for="terms">
                        <span></span>
                        Acepto términos y condiciones
                    </label>
                </div>
                <div class="input-checkbox mt-10">
                    <input type="checkbox" id="suscribete" name="suscribete">
                    <label for="suscribete">
                        Suscribete para recibir ofertas, promociones y nuevos productos
                    </label>
                </div>

 <br>
                

                <button class="btn btn-success btn-sm m-t-10 text-center" type="submit">REGISTRARSE</button>&nbsp;&nbsp;
                <a href="{{ url('./') }}"><button class="btn btn-warning btn-sm m-t-10"
                        type="button">CANCELAR</button></a>&nbsp;

                {{-- <button class="btn btn-warning btn-sm m-t-10" type="reset" align="right">RESET</button> --}}

            </div>
        </div>
        <br>
        </form>
        {!!Form::close()!!}
    </div>
</div>
</div>
<!-- End Cart -->

{{--  <script src="{{asset('vendors/nice-select/js/jquery.nice-select.min.js')}}"></script> --}}
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
{{--  <script src="{{asset('js/check.js')}}"></script> --}}
<script src="{{asset('js/sweetalert.min.js')}}"></script>

<script>
    $( document ).ready(function() {
        $('#departamento').change(function(){
        var query = $(this).val()*1; 
        if(query != '')
        {
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
        url:"{{route('online.municipio')}}",
        method:"POST",
        data:{query:query, _token: _token},
        success:function(data){

        var municipio;
          for (var i=0; i<data.length;i++)
            municipio+='<option value="'+data[i].ID+'">'+data[i].MunName+'</option>'
        $("#id_municipio").html(municipio);
       // $('select').niceSelect('update');
        }
        });
        }
    });


    
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
        $( "#registrarse" ).submit(function( event ) {
            if( $('#terms').is(':checked') ) {
                $( "#registrarse" ).submit();
            $('#espere_agregar').removeAttr("style"); 
            }else{
                swal("Advertencia", "Aceptar términos y condiciones","warning");
            }
        
        event.preventDefault();

    });
    



</script>




@endsection



{{--   <p><B> SI NECESITA CREDITO FISCAL LLENE LOS SIGUIENTES CAMPOS </B></p> --}}
{{--    <div class="mb-3">
                        <label for="contacto">Nombre Empresa según NIT</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="contacto" placeholder="" value="{{ old('contacto') }}"
>

</div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="iva">NIT</label>
        <input type="text" class="form-control" name="nit" placeholder="" value="{{ old('nit') }}">

    </div>
    <div class="col-md-6 mb-3">
        <label for="iva">N° de Registro </label>
        <input type="text" class="form-control" name="iva" placeholder="" value="{{ old('iva') }}">

    </div>
</div>

<div class="mb-3">
    <label for="giro">Giro </label>
    <input type="giro" class="form-control" name="giro" placeholder="" value="{{ old('giro') }}">

</div>

<br> --}}