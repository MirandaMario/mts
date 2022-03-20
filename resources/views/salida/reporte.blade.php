@extends('layouts.admin')
@section('title','Reporte de salidas')
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
            <h5 align="center">Reporte de Salidas al día {{date('d/m/Y', strtotime($request->fecha))}} </h5>
            @else
            <h5 align="center">Reporte de Salidas
                del {{date('d/m/Y ', strtotime($request->fecha))}} hasta {{date('d/m/Y', strtotime($request->fecha2))}}
            </h5>
            @endif

            @if ($request->tipo_comprobante == 3)
            Salidas filtradas por CCF<br>
            @elseif($request->tipo_comprobante == 2)
            Salidas filtradas por Factura<br>
            @elseif($request->tipo_comprobante == 1)
            <br> Salidas filtradas por Ticket <br>
            @else
            <h5>  TODAS LAS SALIDAS </h5>
            @endif
            <br>
            <table class="table table-condensed table-striped " style="font-size:12px;" border="0" width="100%" id="table_beneficio">
                <thead>
                    <tr>
                        <th HEIGHT="25" class="text-left" align="left" width="2%"># </th>
                        <th class="text-center" align="center" width="5%">ID </th>
                        <th class="text-left" align="center" width="10%">Proveedor</th>
                        <th class="text-left" align="center" width="5%">Tipo</th>
                        <th class="text-center" align="center" width="5%">Numero</th>
                        <th class="text-center" align="left" width="50%">Concepto</th>
                        <th class="text-right" width="5%">Valor</th>
                        <th class="text-right" align="right" width="7%">Fecha</th>
                        <th class="text-right"align="right" width="7%">IVA</th>
                        <th class="text-right"align="right" width="7%">IMP1+2</th>
                        <th class="text-right"align="right" width="7%">Retencion</th>
                    </tr>

                </thead>
                <tbody>
                    @php $i2 = 0; $i = 1; $i3= 0 @endphp
                    @foreach($salidas as $sal)
                    <tr>
                        <td class="text-left" align="left">{{$i++}}</td>
                        <td class="text-left" align="left">{{$sal->id_salida}}</td>
                        <td class="text-left" align="left">{{$sal->id_proveedor}}</td>
                        <td class="text-left" align="left">{{$sal->tipo}}</td>
                        <td class="text-left" align="left">{{$sal->numero}}</td>
                        <td class="text-left" align="left">{{$sal->concepto}}</td>
                        @php  $i3 = $sal->valor+$sal->iva+$sal->retencion+$sal->imp1+$sal->imp2; 
                        $i2 += $i3 @endphp
                        <td class="text-right" align="right">{{round($i3,2)}}</td>
                        <td class="text-center" align="center">{{date('d/m/y' , strtotime($sal->fecha))}}</td>
                        <td class="text-left" align="left">{{$sal->iva}}</td>
                        <td class="text-left" align="left">{{$sal->imp1+$sal->imp2}}</td>
                        <td class="text-left" align="left">{{$sal->retencion}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-right" align="right">SUMAS $</th>  
                    <th class="text-right">{{number_format($i2, 2, '.', ',')}}</th>
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
