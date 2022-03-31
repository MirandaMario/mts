@extends('layouts.admin')
@section('title','Cliente')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('partial.error')
@php
use App\Persona;
@endphp
<div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            @if (isset($persona))
            <div class="panel-heading" style="font-size:150%; height: 40px;">Editar Paciente/Responsable</div>
            <div class="panel-body">
                {!!Form::model($persona,['method'=>'PATCH','autocomplete'=>'off','route'=>['cliente.update',$persona->idpersona]])!!}
                @else
                <div class="panel-heading" style="font-size:150%; height: 40px;">Nuevo Paciente/Responsable</div>
                <div class="panel-body">
                    {!!Form::open(array('url'=>'cliente','method'=>'POST','autocomplete'=>'off', 'id'=>'cliente_form'))!!}
                    @endif
                    {{Form::token()}}

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Nombre</label></b></div>
                                    <input type="text" name="nombre"
                                        value="{{isset($persona->nombre) ?  $persona->nombre : old('nombre')}}"
                                        class="form-control" placeholder="Nombre..." required />

                                </div>
                                @if ($errors->has('nombre'))
                                <span class="text-danger" style="background: write;">{{ $errors->first('nombre') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"> <b><label class="a">Alias</label></b></div>
                                    <input type="text" name="alias"
                                        value="{{isset($persona->alias) ?  $persona->alias :old('Alias')}}"
                                        class="form-control" placeholder="Alias..." />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"> <b><label class="a">Dirección</label></b></div>
                                    <input type="text" name="direccion"
                                        value="{{isset($persona->direccion) ?  $persona->direccion :old('direccion')}}"
                                        class="form-control" placeholder="Dirección..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"> <b><label class="a">Depto.</label></b></div>
                                    <select id="departamento" name="departamento" class="form-control">


                                        @if (isset($persona))
                                        @foreach($departamentos as $dep)
                                        <option value="{{$dep->ID}}"
                                            {{$dep->ID == $persona->id_dep ? "selected" : "" }}>{{$dep->DepName}}
                                        </option>
                                        @endforeach
                                        @else

                                        <option value="" selected="selected">Departamento</option>
                                        @foreach($departamentos as $dep)
                                        <option value="{{$dep->ID}}"
                                            {{(old('departamento') == $dep->ID)? "selected"  : ""}}>{{$dep->DepName}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Municipio</label></b></div>
                                    <select name="id_municipio" id="id_municipio" class="form-control" required>

                                        @if (isset($persona))
                                        <option value="{{$persona->id_mun}}" selected="selected">{{$persona->MunName}}
                                        </option>
                                        @else
                                        @if (old()!= null)
                                        @php $m= Persona::municipio(old('id_municipio')); @endphp
                                        <option value="{{$m->ID}}" selected="selected">{{$m->MunName}}</option>
                                        @endif
                                        @endif

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">DUI</label></b></div>
                                    <input type="text" name="dui"
                                        value="{{isset($persona->dui) ?  $persona->dui : old('dui')}}"
                                        class="form-control" placeholder="DUI..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">NIT</label></b></div>
                                    <input type="text" name="nit"
                                        value="{{isset($persona->nit) ?  $persona->nit : old('nit')}}"
                                        class="form-control" placeholder="NIT..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">F. Nac</label></b></div>
                                    <input type="text" name="fecha_nac"
                                        value="{{isset($persona->fecha_nac) ?  $persona->fecha_nac : old('fecha_nac')}}"
                                        class="form-control" placeholder="F. Nac..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">FormaPago</label></b></div>
                                    <select class="form-control" name="forma_pago" id="forma_pago">
                                        <option value="Credito"
                                            {{ isset($persona->iva) ? $persona->forma_pago == 'Credito' ? 'selected' : ""  : old('forma_pago') == "Credito" ? "selected" : ""}}>
                                            Crédito</option>
                                        <option value="Contado"
                                            {{ isset($persona->iva) ? $persona->forma_pago == 'Contado' ? 'selected' : ""  : old('forma_pago') == "Contado" ? "selected" : ""}}>
                                            Contado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Registro</label></b></div>
                                    <input type="text" name="iva"
                                        value="{{isset($persona->iva) ? $persona->iva : old('iva')}}"
                                        class="form-control" placeholder="IVA..." />
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"> <b><label class="a">Giro</label></b></div>
                                    <input type="text" name="giro"
                                        value="{{isset($persona->giro) ?  $persona->giro :old('giro')}}"
                                        class="form-control" placeholder="Giro..." />
                                </div>

                            </div>
                        </div>
                     {{--    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Tipo Contr.</label></b></div>
                                    <select class="form-control" name="tipo_contribuyente" id="tipo_contribuyente">
                                        <option value="Pequeño"
                                            {{ isset($persona->tipo_contribuyente) ? $persona->tipo_contribuyente == 'Pequeño' ? 'selected' : ""  : old('tipo_contribuyente') == "Pequeño" ? "selected" : ""}}>
                                            Pequeño</option>
                                        <option value="Mediano"
                                            {{ isset($persona->tipo_contribuyente) ? $persona->tipo_contribuyente == 'Mediano' ? 'selected' : ""  : old('tipo_contribuyente') == "Mediano" ? "selected" : ""}}>
                                            Mediano</option>
                                        <option value="Grande"
                                            {{ isset($persona->tipo_contribuyente) ? $persona->tipo_contribuyente == 'Grande' ? 'selected' : ""  : old('tipo_contribuyente') == "Grande" ? "selected" : ""}}>
                                            Grande</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                    </div>

             {{--        <div class="row">
                    
                   
                     
                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"> <b><label class="a">Estado</label></b></div>
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="Activo"
                                            {{ isset($persona->estado) ? $persona->estado == 'Activo' ? 'selected' : ""  : old('estado') == "Activo" ? "selected" : ""}}>
                                            Activo</option>
                                        <option value="Inactivo"
                                            {{ isset($persona->estado) ? $persona->estado == 'Inactivo' ? 'selected' : ""  : old('estado') == "Inactivo" ? "selected" : ""}}>
                                            Inactivo</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
 --}}

                <!--credenciales cliente  -->
             {{--        <div class="row">
                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">User Name</label></b></div>
                                    <input type="text" name="username"
                                        value="{{isset($persona->iva) ? $persona->iva : old('iva')}}"
                                        class="form-control" placeholder="User Name..." />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Contraseña</label></b></div>
                                    <input type="text" name="contrasena"
                                        value="{{isset($persona->iva) ? $persona->iva : old('iva')}}"
                                        class="form-control" placeholder="Contraseña..." />
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--contacto  -->
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Contacto 1</label></b></div>
                                    <input type="text" name="contacto"
                                        value="{{isset($persona->contacto) ? $persona->contacto : old('contacto')}}"
                                        class="form-control" placeholder="Contacto..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Tel. 1</label></b></div>
                                    <input type="text" name="tel"
                                        value="{{isset($persona->tel) ? $persona->tel : old('tel')}}"
                                        class="form-control" placeholder="Tel..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">email 1</label></b></div>
                                    <input type="text" name="email"
                                        value="{{isset($persona->email) ? $persona->email : old('email')}}"
                                        class="form-control" placeholder="email..." />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--contacto 2 -->
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Contacto 2</label></b></div>
                                    <input type="text" name="contacto2"
                                        value="{{isset($persona->contacto2) ? $persona->contacto2 : old('contacto2')}}"
                                        class="form-control" placeholder="Contacto 2..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Tel. 2</label></b></div>
                                    <input type="text" name="tel2"
                                        value="{{isset($persona->tel2) ? $persona->tel2 : old('tel2')}}"
                                        class="form-control" placeholder="Tel 2..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">email 2</label></b></div>
                                    <input type="text" name="email2"
                                        value="{{isset($persona->email2) ? $persona->email2 : old('email2')}}"
                                        class="form-control" placeholder="email..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--contacto 3 -->
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Contacto 3</label></b></div>
                                    <input type="text" name="contacto3"
                                        value="{{isset($persona->contacto3) ? $persona->contacto3 : old('contacto3')}}"
                                        class="form-control" placeholder="Contacto 3 ..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Tel. 3</label></b></div>
                                    <input type="text" name="tel3"
                                        value="{{isset($persona->tel3) ? $persona->tel3 : old('tel3')}}"
                                        class="form-control" placeholder="Tel 3..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg- col-sm-4 col-md-4 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">email 3</label></b></div>
                                    <input type="text" name="email3"
                                        value="{{isset($persona->email3) ? $persona->email3 : old('email3')}}"
                                        class="form-control" placeholder="email..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--fin-->
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12 pa">
                            @if (isset($persona))
                            <button class="btn btn-success btn-sm m-t-10" type="submit">ACTUALIZAR</button>
                            <a href="{{ url('/cliente') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a>

                            <button class="btn btn-warning btn-sm m-t-10" type="reset" align="right">RESET</button>
                            @else
                            <button class="btn btn-success btn-sm m-t-10" type="submit" id="btn">GUARDAR</button>
                            <a href="{{ url('/cliente') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a>

                            <button class="btn btn-warning btn-sm m-t-10" type="reset" align="right">RESET</button>
                            @endif
                        </div>
                    </div>

                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

    <script>
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
            console.log(data);
        
         var municipio;
              for (var i=0; i<data.length;i++)
                municipio+='<option value="'+data[i].ID+'">'+data[i].MunName+'</option>'
            $("#id_municipio").html(municipio);
          }
         });
        }
        });
      

    
    $(document).ready(function(){
        $("#varios").css("color", "orange");
        $('#cliente_form').on('submit', function(e) {
        $('#btn').attr("disabled", true);
    });
    });
    </script>

    @endsection