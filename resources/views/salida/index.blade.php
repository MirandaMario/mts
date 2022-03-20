@extends('layouts.admin')
@section('title','Salidas')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<style>
    .center {
        margin-left: auto;
        margin-right: auto;
        display: block;
    }
</style>

<div class="row">
 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
    <div class="panel panel-primary" >
        <div class="panel-heading ">
            @include('salida.busqueda')  
        </div>
      
        <div class="panel-body">
            <div class="table-responsive">  
            <table class="table table-hover display compact  nowrap responsive" id="art" style="display:none;">
                <thead>
                    <th class="text-center">ID</th>
                    <th class="text-left">ID Proveedor</th>
                    <th class="text-center">Numero</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Concepto</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Retencion</th>
                    <th class="text-center">IVA</th>
                    <th class="text-center" >Imp1</th>
                    <th class="text-center" >Imp2</th> 
                    <th>Acciones</th>
                </thead>
                <tbody class="responsive">
                    @foreach($salidas as $sal)
                    <tr>
                        <td><b>{{$sal->id_salida}} </b></td>
                        <td>{{$sal->id_proveedor}}</td>
                        <td>{{$sal->numero}}</td>
                        <td>{{$sal->tipo}}</td>
                        <td>{{$sal->concepto}}</td>
                        <td>{{round($sal->valor+$sal->iva+$sal->imp1+$sal->imp2+$sal->retencion,2)}}</td>
                        <td>{{$sal->fecha}}</td>
                        <td>{{$sal->retencion}}</td>
                        <td>{{$sal->iva}}</td>
                        <td>{{$sal->imp1}}</td>
                        <td>{{$sal->imp2}}</td>
                        <td><a href="{{URL::action('SalidaController@edit',$sal->id_salida)}}" target="_blank">
                            <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                            </span>
                        </a></td>
                    
                       
                       
                      
                        {{-- <td class="text-center">
                            &nbsp;&nbsp;
                            <a href="{{URL::action('ArticuloController@show3',$art->idarticulo)}}" target="_blank">
                                <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                </span>
                            </a>
                            &nbsp; &nbsp; 
                            @if (auth()->user()->rol == 1 )
                            <a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}" target="_blank">
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                </span>
                            </a>
                            &nbsp; &nbsp; 
                            <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal">

                                <span aria-hidden="true" class="glyphicon glyphicon-minus-sign">
                                </span>
                            </a> @endif
                        </td>
                     <td>{{number_format($precio[2], 2)}}</td>
                     <td> 
                        @if ($art->imagen1 != null)
                        <img src="{{ asset("imagenes/articulos/".$art->imagen1)  }}" height="100px"
                        width="100px" /></td>
                        @else
                            
                        @endif  --}}
                        
                    </tr>
                   {{--  @include('almacen.articulo.modal') --}}
                    @endforeach
                </tbody>
            </table>
            <div id="div2" class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 pa"
                style=" background-color: white; height:100%">
                <img src="{{asset('images/procesando.gif')}}" class="center">
                <br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

<script>
    $(document).ready(function(){
            $("#articulos").css("background-color", "orange");   
            $("#div2").attr("style", "display:none"); 
            $("table").removeAttr("style","display:none"); 
            
            $('#art').DataTable({
      
                responsive: true,  
                language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
                },
       
        "order": [[ 0, "desc" ]],
        "aLengthMenu": [[100, 25, 50, 75, -1], [100, 25, 50, 75, "All"]],
        "iDisplayLength": 100,
              

    });
});


var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

$('#articulo').keyup(function () {
    
    var query = $(this).val();
    if (query != '') {
        delay(function () {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "articulos_palabra",
                method: "POST",
                data: { query: query, _token: _token },
                success: function (data) {
                    $('#ListaProductos').fadeIn();
                    $('#ListaProductos').html(data);
                }
            });
        }, 400);
    }
});


$('#ListaProductos').on('click', 'li', function () {

    $('#ListaProductos').fadeOut();
    var datosArticulo = $(this).text().split('      ');
    $('#articulo').val(datosArticulo[0]);
    $('#articulo').attr({ 'style': 'background-color: white; font-size: 20px;' });
   
});

</script>


@endsection