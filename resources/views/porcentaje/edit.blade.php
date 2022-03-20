<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$por->idPorcentaje}}">
    {{Form::Open(array('action'=>array('PorcentajeController@update',$por->idPorcentaje),'method'=>'PATCH','autocomplete="off"'))}}
 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">Editar porcentaje</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-4">Nombre : </label>
                        <div class="col-md-8">
                            <input type="text" name="porcentaje" class="form-control"  value="{{$por->porcentaje}}"/>
                        </div>
                    </div>
            </div>
            <br>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-danger">
                    Actualizar
                </button>
            </div>

        </div>
    </div>
    {{Form::Close()}}
</div>









{{-- @extends('layouts.admin')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

    <div class="row" style="{{ config('constantes.FONT') }}">
        <div class="col-md-6 pa">
            <div class="panel panel-primary">
                <div class="panel-heading" style="font-size:150%; height: 40px;">
                     Editar porcentaje 
                </div>
                    <div class="panel-body">
                        {!!Form::model($porcentaje,['method'=>'PATCH','route'=>["porcentaje.update",$porcentaje->idPorcentaje], 'autocomplete="off"'])!!}
                        {{Form::token()}}
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                                    <div class="form-group">
                                        <label for="porcentaje">Porcentaje</label>
                                        <input type="number" name="porcentaje" class="form-control" value="{{$porcentaje->porcentaje}}" placeholder="Porcentaje...">
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <button class="btn btn-success btn-sm m-t-10" type="submit">Guardar</button>
                                    <a href="{{ url('/porcentaje') }}"><button class="btn btn-primary btn-sm m-t-10"   type="button">Cancelar</button></a>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@endsection
 --}}