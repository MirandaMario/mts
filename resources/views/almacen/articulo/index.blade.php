@extends('layouts.admin')
@section('title','Artículos')
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
        <div class="panel-heading " style="text-align:right; ">
        @php
            function isMobileDevice() {
                return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
            |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
            , $_SERVER["HTTP_USER_AGENT"]);
            }    
        @endphp
        @if(isMobileDevice())
            @include('almacen.articulo.busqueda_movil') 
        @else
            @include('almacen.articulo.busqueda')
        @endif      
        </div>
        <div class="row " style=" white-space : normal; ">
            @if(isMobileDevice())
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa" style="position: absolute; " >
                    
                    <table   id="ListaProductos" name="ListaProductos"  class="table table-sm"   WIDTH="80%" {{--  --}}>
                    </table>
                    
                </div>
            @else
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pa">
                </div> 
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pa">
                    <div id="gitarticulo" style="position: absolute; "></div>
                    <div  id="ListaProductos" name="ListaProductos"  style="position: absolute; text-align:right;"></div>
                </div>
            @endif 
             
        </div>
       
        <div class="panel-body">
            <div {{-- class="table-responsive" --}}>  
            <table class="table table-striped table-bordered  nowrap responsive" id="art" style="display:none;">
                <thead>
                    <th class="text-center">Nombre || Modelo</th>     
                    <th class="text-left">IDART</th>
                    <th class="text-center">Código</th>
                    <th class="text-center">Marca</th>
                    <th class="text-center">Categoría</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">CDC</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">PCD</th>
                    <th class="text-center">DET2</th>
                    <th class="text-center">MAYO</th>
                    <th>Acciones</th>
                    <th class="text-center" >Utilidad</th>
                    <th class="text-center" >IMG</th>
                    <th class="text-center" >Idioma</th>
                    <th class="text-center" >Color</th>
                    <th class="text-center" >Variante</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center" >Min</th>
                    <th class="text-center" >Max</th>
                    <th class="text-center" >T_</th>
                </thead>
                <tbody class="responsive">
                    @foreach($articulos as $art)
                    @php $precio = precio($art , $varios) @endphp
                    <tr>
                        <td  class="fila{{$art->idarticulo}}"><b>{{$art->nombre}} {{$art->nombreModelo}} {{$art->color}}</b></td>
                        
                       {{--  <td class="text-center">{{$art->tamano}}</td> --}}
                        <td class="text-center"><b> <a style="color:black;"
                                    href="{{URL::action('ArticuloController@show',['id' => $art->idarticulo /* , 'id2' => $art->id */])}}" >
                                    {{ $art->idarticulo }}</b></a>
                        </td>
                        <td>{{$art->codigo}}</td>
                        <td>{{$art->nombreMarca}}</td>
                        <td>{{$art->nombreCategoria}}</td>
                        <td class="text-center">
                            {{-- @if (auth()->user()->rol == 1)
                            <span style="visibility: hidden; "> {{$art->stock}}</span>  <input class="stock"  fila="{{$art->idarticulo}}" type="number"  style="width:30px;border:none; text-align:left; " step="1"  value="{{$art->stock}}">
                            @else --}}
                                {{$art->stock}}
                           {{--  @endif --}}
                        </td>
                        <td class="text-center">
                            @if (auth()->user()->rol == 1)
                            {{-- <span style="visibility: hidden; "> {{$art->stock}}</span> --}}  <input class="cdc"  fila="{{$art->idarticulo}}" type="number"  style="width:30px;border:none; text-align:left; " step="1"  value="{{$art->cdc}}">
                            @else
                                {{$art->cdc}}
                            @endif
                        </td>
                        <td class="text-right">{{number_format($precio[0], 2, '.', ',')}} </td>
                        <td class="text-right">{{number_format($precio[1], 2, '.', ',')}} </td>
                        <td class="text-right">{{number_format($precio[4], 2, '.', ',')}} </td>
                        <td class="text-right">{{number_format($precio[6], 2, '.', ',')}} </td>
                       
                        <td class="text-center">
                            &nbsp;&nbsp;
                            <a href="{{URL::action('ArticuloController@show3',$art->idarticulo)}}" >
                                <span aria-hidden="true" class="glyphicon glyphicon-sunglasses">
                                </span>
                            </a>
                            &nbsp; &nbsp; 
                            @if (auth()->user()->rol == 1 )
                            <a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}">
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
                        @if ($art->imagen5 != null)
                            <img src="{{ asset("imagenes/articulos/".$art->imagen5)  }}" height="100px"  width="100px" /></td>
                        @elseif($art->imagen1 != null)  
                            <img src="{{ asset("imagenes/articulos/".$art->imagen1)  }}" height="100px"  width="100px" /></td> 
                        @else                       
                        @endif  
                    
                    <td class="text-center">{{$art->idioma}}</td>
                    <td class="text-center">{{$art->color}}</td>
                    <td class="text-center">{{$art->variantede}}</td>
                    <td class="text-center">{{$art->estado}} {{$art->publicado}}</td>
                    <td class="text-center">{{$art->min}}</td>
                    <td class="text-center">{{$art->max}}</td>
                    <td class="text-center">
                            @if ($art->tipo == 0 || $art->tipo == null)
                            Articulo Comun
                            @elseif($art->tipo == 1)
                            Articulo Externo
                            @elseif($art->tipo == 2)
                            Servicio Externo
                            @else
                            Servicio Interno
                            @endif
                    </td>

                    </tr>
                    @include('almacen.articulo.modal')
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
<script src="{{asset('js/articulo/asincronos_index.js')}}"></script>
<script>
    $(document).ready(function(){
        /* $(".stock").focus(function() {
            var trid = $(this).attr("id")
           console.log (trid)
            $('#'+trid).keyup(function(){
                var idtr = trid
                var valor = $('#'+trid).val()
              //   console.log (idtr)
              console.log (valor )

                if(valor != '')
                {delay(function()
            {
             var _token = $('input[name="_token"]').val();
             $.ajax({
              url:"{{ route('updatedstock') }}",
              method:"POST",
              data:{    query : idtr,
                        query2 : valor,
                        _token: _token},
              success:function(data){
              //  $('#ListaClientes').fadeIn();
                    $(".fila"+trid).css("background-color", "orange");  
                     {delay(function() {
                    $(".fila"+trid).removeAttr('style');

                    },5000);}
              }
             });
            },700);   }
        });
      }); */

            $("#articulos").css("background-color", "orange");   
            $("#div2").attr("style", "display:none"); 
            $("table").removeAttr("style","display:none"); 
            $("#idCategoria").change(function() {
                $("#formindex").submit();
            });
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
       
        "order": [[ 1, "desc" ]],
        "aLengthMenu": [[100, 25, 50, 75, -1], [100, 25, 50, 75, "All"]],
        "iDisplayLength": 100,
           "columnDefs": [

    { responsivePriority: 1, targets: 0 },
    { responsivePriority: 2, targets: 6 },
    { responsivePriority: 3, targets: 10 },
   
  ]/* ,
        'rowCallback': function(row, data, index){

         if (data[5] == "0")
       {
        $(row).find('td:eq(5)').css('background-color', '#fca9a9');
       }

        else if (data[5] == data[18])
        {
            $(row).find('td:eq(5)').css('background-color', '#FFFF99');
        }

        else if (data[5] <= (data[18]*1) )
        {
            $(row).find('td:eq(5)').css('background-color', '#ffa07a');
        }

         else if (data[5] > (data[19]*1) )
        {
            $(row).find('td:eq(5)').css('background-color', '#ADFF2F');
        }
       } */
    });
});

/* var delay = (function(){
    var timer = 0;
    return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();  */
</script>
@endsection