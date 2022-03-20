@extends('layouts.admin')
@section('title','Benefico Artículos')
@section('contenido')


<div id="muestra">
    {{-- <img align="left" width="125" height="85" src="{{asset('imagenes/logo.jpg')}}"> --}}
    <h4 align="center"> {{ config('constantes.COMPANY') }} </h4>



    <h5 align="center">Reporte de Productos Benefico Rentabilidad</h5>
    <br>
    {{-- {{$r}} --}}
    <br>
    <table class="table table-condensed table-striped table-bordered-striper" style="font-size:100%; width:50%;">
        <tr>
            <td>S</td>
            <td>STOCK.</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>AC</td>
            <td>Total Articulos Comprados</td>
            <td>$.CT</td>
            <td>Compra Total en $</td>
        </tr>
        <tr>
            <td>AV</td>
            <td>Total Articulos Vendidos</td>
            <td>$.VT</td>
            <td>Venta Total en $</td>
        </tr>
        <tr>
            <td>Pro</td>
            <td>Proyeccion Venta total</td>
            <td>C.M.</td>
            <td>Costo promedio del articulo</td>
        </tr>
        <tr>
            <td>R.$</td>
            <td>Rentabilidad en $</td>
            <td>R.%</td>
            <td>Rentabilidad en %</td>
        </tr>
    </table>
    <br>    <br>    <br>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-bordered-striper table-hover table-responsive table-striped"
                    style="font-size:100%; width:100%;" id="my_table" >

                    <thead>
                        <tr>
                            <th class="text-left" align="left" >#</th>
                            <th class="text-left" align="left" width="5%">Id</th>
                            <th class="text-left" align="left" >Nombre || Modelo</th>
                            <th class="text-center">S</th>
                            <th class="text-center">AC</th>
                            <th class="text-center">AV</th>
                            <th class="text-right">$.CT</th>
                            <th class="text-right">$.VT</th>
                            <th class="text-right">Pro.</th>
                            <th class="text-right">C.M.</th>
                            <th class="text-right">R.$</th>
                            <th class="text-right">R.%</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($articulos as $a)
                        @php $precio = precio($a , $varios) @endphp
                        <tr style="font-size:12px;">
                            <td class="text-left"   align="left">{{$i++}}</td>
                            <td>{{$a->idarticulo}}</td>
                            <td>{{$a->nombre . '  '. $a->nombreModelo}}</td>
                            <td class="text-right">{{$a->artc - $a->artv}}</td>
                            <td class="text-right">{{$a->artc}}</td>         {{--cantidad total articulos comprados--}}
                            <td class="text-right">{{$a->artv}}</td>         {{--cantidad total articulos vendidos --}}  
                            <td class="text-right">{{number_format( $a->ctar * 1.13 , 2, '.', ',')}}</td>   {{--COMPRA TOTAL--}}
                            <td class="text-right">{{number_format( $a->vtar , 2, '.', ',') }}</td>
                            <td class="text-right">{{number_format((($a->artc - $a->artv)*$precio[1]) + $a->vtar, 2, '.', ',')}}</td>
                            <td class="text-right">{{number_format(($a->ctar * 1.13)/$a->artc , 2, '.', ',') }}</td>
                            <td class="text-right">{{number_format((($a->vtar + (($a->artc - $a->artv)*$precio[1])) - ($a->ctar * 1.13))/ $a->artc , 2, '.', ',')}}</td>
                            <td class="text-right">{{number_format(((($a->vtar + (($a->artc - $a->artv)*$precio[1])) - ($a->ctar * 1.13))/ ($a->ctar * 1.13)) * 100 , 2, '.', '')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
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