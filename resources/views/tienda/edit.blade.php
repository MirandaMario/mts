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
               Editar Control  
            </div>

            <div class="panel-body">
            {!!Form::model($tienda,['method'=>'PATCH','route'=>["tienda_conf.update",$tienda->id],'autocomplete="off"'])!!}
             {{Form::token()}}


             <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                    <div class="form-group">
           
                        <label for="tipo" class="apa">Nombre tienda </label>
                        <input type="text" name="nombreTienda" class="form-control" value="{{$tienda->nombreTienda}}" placeholder="nombre de Tienda...">
                    </div>
                </div>
            </div>

             <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                    <div class="form-group">
           
                        <label for="tipo" class="apa">Cotización </label>
                        <input type="text" name="cotizacion" class="form-control" value="{{$tienda->cotizacion}}" placeholder="Cotización...">
                    </div>
                </div>
            
                
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                    <div class="form-group">
            
                        <label for="tipo" class="apa">Ticket</label>
                        <input type="text" name="ticket" class="form-control" value="{{$tienda->ticket}}" placeholder="Ticket...">
                    </div>
                </div>
                    
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                     <div class="form-group">
                   
                        <label for="tipo" class="apa">Factura</label>
                        <input type="text" name="factura" class="form-control" value="{{$tienda->factura}} "placeholder="Factura...">
                    </div>
                </div>
            
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                     <div class="form-group">
                   
                        <label for="tipo" class="apa">CCf</label>
                        <input type="text" name="ccf" class="form-control" value="{{$tienda->ccf}}"placeholder="CCF...">
                    </div>
                </div>
            </div>

     
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                     <div class="form-group">
                   
                        <label for="tipo" class="apa">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{$tienda->direccion}} "placeholder="Dirección...">
                    </div>
                </div>
            </div>
     

       

            <div class="row">
                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 pa">
                    <div class="form-group">

                    <button class="btn btn-success btn-sm m-t-10" type="submit">GUARDAR</button>
              
                    <a href="{{ url('tienda_conf') }}"><button class="btn btn-primary btn-sm m-t-10"   type="button">CANCELAR</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        {!!Form::close()!!}

</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>    
<script> 
    $(document).ready(function(){
        $("#conf").css("color", "orange");
    });
</script>
@endsection