@extends('layouts.admin')
@section('contenido')
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
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
             <h4 class="panel-title" style="font-size: 25px"> Editar modelo : {{$modelo->nombreModelo}}</h4>
            </div>
            <div class="panel-body">

        {!!Form::model($modelo,['method'=>'PATCH','autocomplete'=>'off', 'route'=>["modelo.update",$modelo->idModelo]] )!!}
        {{Form::token()}}


        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label>Marca &nbsp;&nbsp;&nbsp;&nbsp; <a href="" data-target="#formMarcaModal"
                            data-toggle="modal">
                            <span class="fa fa-plus-square" aria-hidden="true"></span></a>
                    </label>
                    <select name="marcas" id="marcas" class="form-control">
                        <option value="{{$modelo->idMarca}}">{{$modelo->nombreMarca}}</option>
                        @foreach($marcas as $mar)
                        <option value="{{$mar->idMarca}}">
                            {{$mar->nombreMarca}}
                        </option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
        <div class="form-group">
            <label for="nombre">Nombre Modelo</label>
            <input type="text" name="nombreModelo" class="form-control" value="{{$modelo->nombreModelo}}" placeholder="Nombre...">
            <input type="hidden" name="idMarca"  id="idMarca" value="{{old('idMarca')}}" class="form-control" >
        </div>
    </div>

         <div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">


                    <br><br>
                <button class="btn btn-success btn-sm m-t-10" type="submit">Guardar</button>

                <a href="{{ url('/marca') }}"><button class="btn btn-primary btn-sm m-t-10"   type="button">Cancelar</button></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-warning btn-sm m-t-10" type="reset"  align="right">Reset</button>
            </div>



            </div>

        </div>

         </div>
</div>
        {!!Form::close()!!}
    </div>
</div>
@endsection
