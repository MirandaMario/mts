@extends('layouts.admin')
@section('title','Reporte Compras')
@section('contenido')
<div id="muestra" >
<img align="left" width="100" height="90" src="{{asset('imagenes/aqui.png')}}">
<h4 align="center"> {{ config('constantes.COMPANY') }} </h4>
@if ($request->fecha == $request->fecha2)
<h5 align="center">Reporte de Compras <br> de {{date('d/m/Y', strtotime($request->fecha))}}  </h5>
@else
<h5 align="center"> Reporte de Compras <br> del  {{date('d/m/Y', strtotime($request->fecha))}}  hasta {{date('d/m/Y', strtotime($request->fecha2))}} </h5>
@endif
<br>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           
      <div class="table-responsive">
        <table class="table table-bordered-striper table-hover table-responsive table-striped"
        style="font-size:100%; width:100%;" id="my_table" >
              <thead>
                 <tr>
                  <th class="text-left" align="left" width="5%">#</th>
                  <th class="text-left" align="left" >Fecha</th>
                  
                  <th class="text-left" align="left" >Provedor</th>
                  <th class="text-left" align="left">Comprobante</th>
                  <th class="text-left" align="left" >N°</th>
                  <th class="text-right" align="right">Total</th>
                  </tr>
              </thead>
               <tbody>
                   @php $i = 1  ;  $i2 = 0;   @endphp
                    @foreach($ingresos as $ing)
               <tr>
                   <td class="text-left" align="left" >@php echo $i++;   @endphp  </td>
                   <td class="text-left" align="left" >{{date('d-m-Y', strtotime($ing->fecha_hora))}}</td>
                   
                   <td class="text-left" align="left" >{{$ing->nombre}}</td>
                   <td class="text-left" align="left">{{$ing->tipo_comprobante}}</td>
                   <td class="text-left" align="left" >{{$ing->num_comprobante}}</td>
                  @if ($ing->tipo_comprobante == "CCF")
                  <td class="text-right" align="right" >{{number_format($ing->total_ingreso, 2, '.', ',') }}
                          @php $i2 +=  $ing->total_ingreso @endphp </td>
                  @else
                  <td class="text-right" align="right" >{{number_format($ing->total_ingreso, 2, '.', ',') }}
                          @php $i2 += $ing->total_ingreso @endphp </td>
                  @endif
      
               </tr>
      
                @endforeach
              </tbody>
              <tfoot>
                  <th colspan="4"></th>
                  <th class="text-left" align="right" >SUMAS $ </th>
                  <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }}  </th>
              </tfoot>
      
      </table>

<hr>
<table class="table table-bordered-striper table-hover table-responsive table-striped"
        style="font-size:100%; width:100%;" id="my_table" >
              <thead>
                 <tr>
                    <th class="text-left"   align="left">NIT</th>
                    <th class="text-left"   align="left">Fecha</th>
                    <th class="text-left"   align="left">TD</th>    {{-- tipo documento  --}}
                    <th class="text-left"   align="left">Serie</th>
                    <th class="text-left"   align="left">N° D</th>  {{-- numero documento  --}}
                    <th class="text-right"  align="right">MTS</th>  {{-- monto sujeto  --}} 
                    <th class="text-right"  align="right">MTP</th>  {{-- monto precepsion  --}} 
                    <th class="text-right"  align="right">D</th>    {{--   --}} 
                    <th class="text-right"  align="right">NA</th>   {{-- numero anexo  --}}
                  </tr>
              </thead>
               <tbody>
                   @php $r = 0 ;   @endphp
                  @foreach($ingresos3 as $ing)
               <tr>
                    <td class="text-left"   align="left">{{-- @php echo $i++;   @endphp  --}} {{ str_replace('-', '', $ing->nit)}}</td>
                    <td class="text-left"   align="left">{{date('d/m/Y', strtotime($ing->fecha_hora))}}</td>
                    <td class="text-left"   align="left">03</td>
                    <td class="text-left"   align="left">{{$ing->serie_comprobante}}</td>
                    <td class="text-left"   align="left">{{ str_replace('-', '', $ing->num_comprobante)}}</td>
                    <td class="text-right"  align="right">{{number_format($ing->total_ingreso/1.13, 2, '.', ',') }}{{-- {{number_format($ing->total_ingreso, 2, '.', ',') }} --}}
                        @php $r +=  $ing->retencion @endphp </td>
                    <td class="text-right"  align="right">{{number_format($ing->retencion, 2, '.', ',') }}</td>
                    <td></td>
                    <td class="text-right"  align="right">8</td>
               </tr>
                  @endforeach
              </tbody>
              <tfoot>
                  <th colspan="6"></th>
                  <th class="text-left" align="right" >SUMAS $ </th>
                  <th class="text-left" align="right" >{{number_format($r, 2, '.', ',') }}</th>
                  <th class="text-left" align="right" ></th>
                  {{-- <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }}  </th> --}}
              </tfoot>
      
      </table>

      </div> 
      <hr><hr>
      <div>
          <table class="table table-hover display compact  nowrap responsive" id="my_table2" >
            <thead>
              <tr>
                {{-- <th class="text-left" align="left" width="5%">#</th> --}}
                <th class="text-left" align="left" width="7%">Fecha</th>
                <th>CD</th>
                <th>TP</th>
                <th class="text-left" align="left" width="5%">N°</th>
                <th class="text-left" align="left" width="5%">NCR</th>
                <th class="text-left" align="left" width="10%">Provedor</th>
                <th>CIE</th>
                <th>IE</th>
                <th>IENS</th>
                <th class="text-left" align="left" >Inter</th>
                <th>IG</th>
                <th>IGB</th>
                <th>IGS</th>         
                <th class="text-left" align="left" >IVA</th>
                <th class="text-right" align="right" width="5%">Total</th>
                <th>D</th>
                <th>N°A</th>
              </tr>
            </thead>
             <tbody>
                 @php $i = 1  ; $fovial = 0;  $intr = 0; $iva = 0 ;  $ret = 0;  $i2 = 0; @endphp
                  @foreach($ingresos as $ing)
             <tr>
                 <td class="text-left" align="left" width="7%">{{date('d/m/Y', strtotime($ing->fecha_hora))}}</td>
                 <td>{{$ing->num_comprobante > 1 ? 1 : 4}}</td>
                 <td>03</td>
                 <td class="text-left" align="left" width="5%">{{ str_replace('-', '', $ing->num_comprobante)}}</td>
                 <td class="text-left" align="left" width="7%">{{ str_replace('-', '', $ing->iva)}}</td>
                 <td class="text-left" align="left" width="15%">{{strToUpper($ing->nombre)}}</td>
                 <td class="text-left" align="left">{{number_format($ing->retencion, 2, '.', ',') }}</td>
                 <td>0.00</td>
                 <td>0.00</td>
                 <td class="text-right" align="right" width="5%">{{number_format($ing->total, 2, '.', '') }}</td>
                 <td>0.00</td>
                 <td>0.00</td>
                 <td>0.00</td>
                 <td class="text-right" align="right" width="5%">{{number_format(($ing->total*$varios->iva), 2, '.', '') }}</td>
                 <td class="text-right" align="right">{{number_format(($ing->total_ingreso +$ing->retencion ), 2, '.', '') }}
                  @php $intr +=  $ing->total ; 
                        $iva +=  $ing->total*$varios->iva ;   
                        $ret +=  $ing->retencion ; 
                        $i2 +=  $ing->total_ingreso; 
                  @endphp
                </td>
                <td></td>
                 <td class="text-center">3</td> 
             </tr>
              @endforeach
            {{--   {{ str_replace('-', ' ', $varios->url3)}} --}}
              @foreach($ingresos2 as $ing)
              <tr>
                  <td class="text-left" align="left" width="7%">{{date('d/m/Y', strtotime($ing->fecha))}}</td>
                  <td>1</td>
                  <td>03</td>
                  <td class="text-left" align="left" width="5%">{{$ing->numero}}</td>
                  <td class="text-left" align="left" width="7%">{{ str_replace('-', '', $ing->ncr)}}</td>
                  <td class="text-left" align="left" width="15%">{{strToUpper($ing->nombre)}}</td>
                  <td class="text-left" align="left">{{number_format($ing->imp1 + $ing->imp2, 2, '.', '')}}</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td class="text-right" align="right" width="5%">{{number_format($ing->valor, 2, '.', '') }}</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td class="text-right" align="right" width="5%">{{number_format(($ing->valor*$varios->iva), 2, '.', ',') }}</td>
                  <td class="text-right" align="right">{{number_format((($ing->valor*1+$varios->iva) + $ing->imp1 + $ing->imp2 ), 2, '.', '') }}
                  @php  $fovial +=  $ing->imp1 + $ing->imp2;  
                        $intr += $ing->valor;  
                        $iva +=  $ing->valor*$varios->iva;  
                        $ret +=  $ing->retencion; 
                        $i2 +=  ($ing->valor*1+$varios->iva) + $ing->imp1 + $ing->imp2;  
                  @endphp </td>
                  <td></td>
                  <td class="text-center">3</td> 
              </tr>
               @endforeach
            </tbody>
            <tfoot>    
                <th colspan="7"></th>
                <th>{{number_format($fovial + $ret , 2, '.', ',') }}</th>
                <th colspan="2"></th>
                <th>{{number_format($intr , 2, '.', ',') }}</th>
                <th colspan="3"></th>
                <th>{{number_format($iva , 2, '.', ',') }}</th>
                <th class="text-right" align="right">{{number_format($i2 , 2, '.', ',') }}  </th>
                <th></th>
            </tfoot>
        </table>
        </div>
    </div>
</div>
<a href="javascript:imprSelec('muestra')" >Imprimir Datos</a>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
  $(document).ready(function(){
  $('#my_table , #my_table2 ').DataTable({
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