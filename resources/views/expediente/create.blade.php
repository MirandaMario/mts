@extends('layouts.admin')
@section('title','Nuevo Artículo')
@section('contenido')


<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
@include('partial.error')
<div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Datos del nuevo Expediente
            </div>
            <div class="panel-body">

                {!!Form::open(array('url'=>'expediente','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
                {{Form::token()}}

                <div class="row">
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                        <div class="form-group">
                            <label for="numero_expedientenombre" class="apa">Expediente n°</label>
                            <input type="text" name="numero_expedientenombre" id="numero_expedientename" required value="{{old('numero_expediente')}}" class="form-control"
                                placeholder="Expediente n°..." autofocus />
                        </div>
                    </div>

                   
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6  pa">
                        <div class="form-group">
                            <label id="gitmodelo">Modelo
                            </label>
                            <a href="" data-target="#formModeloModal" data-toggle="modal">++</a>
                            <select name="idModelo" id="idModelo" class="form-control">
                                <option value="1" selected>Modelo</option>
                            </select>

                        </div>
                    </div>
                
                </div>
                
                <div class="row">
                   
            
                
         
                
                </div>
            
                
                </div>
                </div>
                <hr>
                <div class="row">
                   
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label class="apa">Tipo &nbsp;</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="0" selected> Articulo Comun </option>
                                <option value="1" > Articulo Externo </option>
                                <option value="2" > Servicio </option>
                                <option value="3" > Servicio Interno</option>
                            </select>
                        </div>
                    </div>
                </div>
                <BR>

                <div class="row  ">
        
                    <div id="botones" class="col-lg-4 col-sm-4 col-md-6 col-xs-12 pa pull-right">
                        <button class="btn btn-success btn-sm m-t-10" type="submit">GUARDAR</button>
                        <a href="{{ url('/expediente') }}"><button class="btn btn-primary btn-sm m-t-10"
                                type="button">CANCELAR</button></a>
                        <button class="btn btn-warning btn-sm m-t-10" type="reset" class="text-right">RESET</button>
                    </div>
                </div>
            </div>
        </div>
        {!!Form::close()!!}

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

@endsection