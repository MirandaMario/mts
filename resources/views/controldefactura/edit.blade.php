@extends('layouts.admin')
@section('title','Editar Control Comprobante')
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
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
               Editar control  
            </div>

            <div class="panel-body">
            {!!Form::model($tienda,['method'=>'PATCH','route'=>["tienda.update",$tienda->id],'autocomplete="off"'])!!}
             {{Form::token()}}

             <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                    <div class="form-group">
           
                        <label for="tipo" class="apa">Serie</label>
                        <input type="text" name="serie" class="form-control" value="{{$tienda->serie}}" placeholder="Serie...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                    <div class="form-group">
            
                        <label for="tipo" class="apa">Correlativo</label>
                        <input type="text" name="correlativo" class="form-control" value="{{$tienda->correlativo}}" placeholder="Correlativo...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                     <div class="form-group">
                   
                        <label for="tipo" class="apa">Resolución</label>
                        <input type="text" name="resolución" class="form-control" value="{{$tienda->resolución}} "placeholder="resolución...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                     <div class="form-group">
                   
                        <label for="tipo" class="apa">Rango</label>
                        <input type="text" name="rango" class="form-control" value="{{$tienda->rango}} "placeholder="rango...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                     <div class="form-group">
                   
                        <label for="tipo" class="apa">Fecha</label>
                        <input type="text" name="fecha" class="form-control" value="{{$tienda->fecha}} "placeholder="fecha...">
                    </div>
                </div>
            </div>
       

            <div class="row">
                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 pa">
                    <div class="form-group">

                    <button class="btn btn-success btn-sm m-t-10" type="submit">Guardar</button>
              
                    <a href="{{ url('tienda') }}"><button class="btn btn-primary btn-sm m-t-10"   type="button">Cancelar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        {!!Form::close()!!}

</div>

@endsection