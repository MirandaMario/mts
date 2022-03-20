@extends('layouts.admin')
@section('title','Editar Cuenta')
@section('contenido')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       
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
        

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
               <h3 class="panel-title" style="font-size:150%;">Editar datos de Cuenta</h3>
            </div>
            <div class="panel-body">

        {!!Form::model($cuenta,['method'=>'PATCH','route'=>["cuenta.update", $cuenta->id]])!!}
        {{Form::token()}}
        <div class="row">
            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre Banco</label>
                    <input type="text" name="banco" required value="{{$cuenta->banco}}" class="form-control" placeholder="Digite nombre banco..."/>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Tipo Cuenta</label>
                    <input type="text" name="tipoCuenta" required value="{{$cuenta->tipoCuenta}}" class="form-control" placeholder="Digite tipo de cuenta..."/>
                </div>
            </div>
            {{-- <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Id Origen de Fondos</label>
                    <input type="number" step="1" name="idCuentaOrigen" required value="{{$cuenta->idCuentaOrigen}}" class="form-control" placeholder="Digite origen cuenta..." />
                </div>
            </div> --}}
           
        </div>
        <div class="row">
            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre Cuenta</label>
                    <textarea class="form-control" rows="3" name="nombreCuenta" required value="">{{$cuenta->nombreCuenta}}</textarea>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Número Cuenta </label>
                    <input type="text" name="numeroCuenta" required value="{{$cuenta->numeroCuenta}}" class="form-control" placeholder="Digite numero de cuenta..."/>
                </div>
            </div>
         
        </div>

        <div class="row">
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                 <div class="form-group">
              
                <button class="btn btn-warning btn-sm m-t-10" type="submit">Actualizar</button>
                <a href="{{ url('/cuenta') }}"><button class="btn btn-primary btn-sm m-t-10"   type="button">Cancelar</button></a>
                   
                </div>  
        
            </div>

        
         </div>
        </div>  </div>  
        
        
    </div>
</div>
</div>
</div>


@endsection