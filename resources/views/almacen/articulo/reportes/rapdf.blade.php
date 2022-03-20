@extends('layouts.admin')
@section('title','Reporte de Artículos')
@section('contenido')


<div id="muestra">
    <img align="left" width="100px" height="100px" src="{{asset('imagenes/aqui.png')}}"> 
    <h4 align="center"> {{ config('constantes.COMPANY') }} </h4>



    <h5 align="center">Reporte de Productos </h5>
    <br>
    {{$r}}
    <br>
    <br>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-bordered-striper table-hover table-responsive table-striped"
                    style="font-size:100%; width:100%;" id="my_table" >

                    <thead>
                        <tr>
                            <th class="text-left" align="left" width="5%">#</th>
                            <th class="text-left" align="left" width="5%">Id</th>
                            <th class="text-left" align="left" width="5%">COD</th>
                            <th class="text-left" align="left" width="30%">Nombre</th>
                            <th class="text-center" align="center" width="5%">Stock</th>
                            <th class="text-left" align="left" width="10%">Marca</th>
                            <th class="text-left" align="left"  width="17%">Categoría</th>
                            <th class="text-right" align="right" width="7%">C/U</th>
                            <th class="text-right" align="right" width="7%">C/Sub</th>
                            <th class="text-right" align="right" width="7%">V/U</th>
                            <th class="text-right" align="right" width="7%">V/Sub</th>

                        </tr>
                        @php $i2 = 0; $i3 = 0; $i4 = 0; @endphp
                       

                    </thead>

                    <tbody>
                        @php $i = 1 @endphp

                        @foreach ($articulos as $a)
                        @php $precio = precio($a , $varios) @endphp
                        <tr style="font-size:10px;">
                            <td class="text-left"   align="left">{{$i++}}</td>
                            <td class="text-left"   align="left">{{$a->idarticulo}}</td>
                            <td class="text-left"   align="left">{{$a->codigo}}</td>
                            <td class="text-left"   align="left">{{$a->nombre}} {{$a->nombreModelo}}  {{$a->color}}</td>
                            <td class="text-right"  align="right"> {{$a->stock}} &nbsp; &nbsp; &nbsp;</td>
                            <td class="text-left"   align="left">{{$a->nombreMarca}}</td>
                            <td class="text-left"   align="left">{{$a->nombreCategoria}}</td>
                            <td class="text-right"  align="right">{{number_format($a->precio * 1.13 , 2, '.', ',')}}</td>
                            <td class="text-right"  align="right">{{number_format((($a->precio  * $a->stock) * 1.13) , 2, '.', ',')}}</td>
                            <td class="text-right"  align="right">{{number_format($precio[1] , 2, '.', ',')}}</td>
                            <td class="text-right"  align="right">
                                {{number_format(($precio [1]  * $a->stock) , 2, '.', ',')}}
                                @php 
                                $i3 += $a->stock; 
                                $i2 += (($a->precio)*($a->stock)) *1.13; 
                                $i4 += (($precio[1] )*($a->stock))@endphp </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <th colspan="3"></th>
                       
                        <th class="text-right" align="right">TOTAL ARTICULOS</th>
                        <th class="text-right" align="right">{{$i3}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</th>
                        <th></th>
                        <th></th>
                        <th class="text-right" align="right">SUMAS </th>
                        <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }} </th>
                        <th></th>
                        <th class="text-right" align="right">{{number_format($i4 , 2, '.', ',') }} </th>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>


<a href="javascript:imprSelec('muestra')">Imprimir Datos</a>


<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $(document).ready(function(){
    $('#my_table').DataTable({
        "order": [[ 2, "desc" ]],
        "aLengthMenu": [[1000000, 25, 50, 75, -1], [1000000, 25, 50, 75, "All"]],
        "iDisplayLength": 1000000,

    "searching" : false,
    "paging"  : false,
    //"infoFiltered": " - filtered from _MAX_ records"
    "info"  : false
    });
});
</script>

<script type="text/javascript">
    function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>


@endsection