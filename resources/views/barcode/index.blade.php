@extends('layouts.admin')
@section('title','Código de Barras')
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


        <div class="row" style="{{ config('constantes.FONT') }}">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="font-size: 25px">Genaración Código de Barras</h3>
                    </div>
                    <div class="panel-body">

                        {!!Form::open(array('url'=>'barcode','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
                        {{Form::token()}}
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Ingrese nombre a convertir</label>
                                    <input type="text" name="barcode" required value="{{old('nombre')}}"
                                        class="form-control" placeholder="Digite valor a convertir..." />
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Descripción</label>
                                    <input type="text" name="descripcion" required value="{{old('descripcion')}}"
                                        class="form-control" placeholder="Digite  Descripción..." />
                                </div>
                            </div>




                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                <div class="form-group">

                                    <button class="btn btn-success btn-sm m-t-10" type="submit">Crear Código</button>
                                    <a href="{{ url('/marca') }}"><button class="btn btn-primary btn-sm m-t-10"
                                            type="button">Cancelar</button></a>

                                </div>

                            </div>

                            <br />
                            <br />
                            <br />
                            <br />

                        </div>
                        <div align="center">
                            @isset($barcode)
                            <img src="data:image/jpg;base64,{{base64_encode($barcode)}}" alt="" width="200"
                                height="50">
                        <h4>{{$label}}</h4>
                        <h4>{{$descripcion}}</h4>
                            @endisset
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


</div>


{{--$label--}}



@endsection
