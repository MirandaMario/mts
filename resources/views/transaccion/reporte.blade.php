@extends('layouts.admin')
@section('title','REPORTE DE REMESAS')
@section('contenido')
<style type="text/css">
    .pa {
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
<div id="muestra">
    <div class="row pa" >
        <div >
            @if ($request->fecha == $request->fecha2)
            <h5 align="center">REPORTE DE REMESAS  {{date('d/m/Y', strtotime($request->fecha))}} </h5>
            @else
            <h5 align="center">REPORTE DE REMESAS
                DEL {{date('d/m/Y ', strtotime($request->fecha))}} HASTA {{date('d/m/Y', strtotime($request->fecha2))}}
            </h5>
            @endif

        <BR>
            <table class="table table-condensed table-striped " style="font-size:12px;" border="0" width="100%" id="table_beneficio">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Cuenta</th>
                        <th>Nombre Cuenta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Concepto General</th>
                        <th class="text-center">Ing</th>
                        <th class="text-center">Fecha&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Opciones</th>
                    </tr>

                </thead>
                <tbody>
                    @php $i2 = 0; @endphp
                    @foreach($remesas as $sal)
                    <tr>

                        <td class="text-center">{{$sal->id}}</td>
                        <td>{{$sal->numeroCuenta}}</td>
                        <td>{{$sal->nombreCuenta}} || {{$sal->conceptog}}
                            @if ($sal->tipoMov === 'INGRESO')
                            {{$sal->concepto}}
                            @endif
                        </td>
                        <td class="text-right">{{number_format($sal->valorIngreso, 2, '.', ',')}}</td>
                        @php $i2 += $sal->valorIngreso @endphp
                        <td class="text-center">{{$newDate = date("d-m-Y", strtotime($sal->fecha))}}</td>
                        <td class="text-center">{{$sal->estado}}</td>
                        <td class="text-center">
                            <a  style="color: black" href="{{URL::action('TransaccionesController@edit',$sal->id)}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-pencil">
                                </span></a>
                        </td>
                  
                    </tr>
                    @endforeach
                </tbody>
                <tr>
                    <th colspan="2"></th>
                    <th class="text-right" align="right">SUMAS $</th>  
                    <th class="text-right">{{number_format($i2, 2, '.', ',')}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </table>
        </div>
    </div>
    <a class="imprimir" href="javascript:imprSelec('muestra')">IMPRIMIR DATOS ACTUALES</a>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $(document).ready(function(){
    $('#table_beneficio,  #top25').DataTable({
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
