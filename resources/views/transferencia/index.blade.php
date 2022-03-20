@extends('layouts.admin')
@section('title','Seleccion Transferencia')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row" style="{{ config('constantes.FONT') }}">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Listado últimas transferencias realizadas
            </div>
            <div class="panel-body">
                <table class="display responsive nowrap compact" id="art" style="font-size:100%; width:100%;">
                    <thead>
                        <th class="text-left" width="5%">ID</th>
                        <th class="text-center">Origen</th>
                        <th class="text-center">Destino</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">---</th>
                    </thead>
                    <tbody>
                        @foreach($transferencias as $t)
                        <tr>
                            <td>{{$t->id_transferencia}}</td>
                            <td>{{$t->id_origen}}</td>
                            <td>{{$t->id_destino}}</td>
                            <td>{{date('d-m-Y H:i' , strtotime($t->created_at))}}</td>
                            <td>{{$t->estado}}</td>
                            <td>{{$t->cantida}}</td>
                            <td>
                                <a href="{{URL::action('TransferenciaController@edit',$t->id_transferencia)}}">
                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    </span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Seleccionar tienda para generar transferencias
            </div>
            {!!Form::open(array('url'=>'transferencia/create','method'=>'get','autocomplete'=>'off', 'id' =>
            'tiendas'))!!}
            {{Form::token()}}
            <div class="row">

                <div class="panel-body">
                    <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12 pa">
                        <div class="form-group">
                            <label class="apa">Tienda Origen </label>
                            <select name="idtienda" id="idtienda" class="form-control">
                                @foreach($tienda as $cat)
                                <option value="{{$cat->id}}">
                                    {{$cat->nombreTienda}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12 pa">
                        <div class="form-group">
                            <label class="apa">Destino</label>
                            <select name="idtienda2" id="idtienda2" class="form-control">
                                @foreach($tienda as $cat)
                                <option value="{{$cat->id}}">
                                    {{$cat->nombreTienda}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                        <label class="apa">&nbsp;</label>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm m-t-10" id="enviar">ENVIAR</button>
                        </div>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>


<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script>
    $(document).ready(function(){ 
    $('#art').DataTable({
      
      "order": [[ 0, "desc" ]],
      "aLengthMenu": [[10, 25, 50, 75, -1], [10, 25, 50, 75, "All"]],
      "iDisplayLength": 10,

      'rowCallback': function(row, data, index){

       if (data[5] == "0")
     {
      $(row).find('td:eq(5)').css('background-color', '#FA5858');
     }

      else if (data[5] == data[8])
      {
          $(row).find('td:eq(5)').css('background-color', 'Yellow');
      }

      else if (data[5] <= (data[8]*1) )
      {
          $(row).find('td:eq(5)').css('background-color', 'Orange');
      }

       else if (data[5] > (data[9]*1) )
      {
          $(row).find('td:eq(5)').css('background-color', '#2EFE2E');
      }

     }

  });
   
 });
    $("#transbtn").css({"color":"orange" , "font-size": "18px"});
    $( "#enviar" ).click(function( event ) {
    event.preventDefault();
    var t = $("#idtienda").val(); 
    var t2 = $("#idtienda2").val(); 
    if (t == t2){
        swal("Advertencia", "Debe de seleccionar tiendas diferentes !!!", "warning");
    }else{
        $("#tiendas").submit()
    }
});


</script>
@endsection