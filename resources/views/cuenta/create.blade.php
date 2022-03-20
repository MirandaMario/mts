@extends('layouts.admin')
@section('title','Nueva Cuenta')
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
               <h3 class="panel-title" style="font-size: 25px">Ingresar datos de nueva cuenta</h3>
            </div>
            <div class="panel-body">

        {!!Form::open(array('url'=>'cuenta','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
        {{Form::token()}}
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre Banco</label>
                    <input type="text" name="banco" required value="{{old('banco')}}" class="form-control" placeholder="Digite nombre banco..."/>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Tipo Cuenta</label>
                    <input type="text" name="tipoCuenta"  value="{{old('tipoCuenta')}}" class="form-control" placeholder="Digite tipo de cuenta..."/>
                </div>
            </div>
           
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre Cuenta</label>
                    <input type="text" name="nombreCuenta" required value="{{old('banco')}}" class="form-control" placeholder="Digite nombre de cuenta..."/>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Número Cuenta </label>
                    <input type="text" name="numeroCuenta" required value="{{old('tipoCuenta')}}" class="form-control" placeholder="Digite numero de cuenta..."/>
                </div>
            </div>
           
        </div>
{{--  
         <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Numero Cheque</label>
                    <input type="text" name="numeroCheque" required value="{{old('banco')}}" class="form-control" placeholder="Digite correlativo cheque..."/>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Serie </label>
                    <input type="text" name="serieCheque" required value="{{old('tipoCuenta')}}" class="form-control" placeholder="Digite serie cheque..."/>
                </div>
            </div>
           
        </div>

--}}
        <div class="row">
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                 <div class="form-group">
              
                <button class="btn btn-success btn-sm m-t-10" type="submit">Guardar</button>
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