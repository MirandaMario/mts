<!DOCTYPE html5>
<title> CORTE {{$corte->correlativo}} </title>
<html lang="en" style="margin: 0px; ">
<link rel="stylesheet" href="{{asset('bootstrap337/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/ticket/prueba.css')}}">
<style>
    .number{
     letter-spacing: -0.1em;
   }
   </style>
  <body onLoad="window.print(); window.close; "> 
    <div id="demo"> 
    <div class="container outer-section text-center">
        <h5 class= text-center><b>{{{$tienda->nombreTienda}}}</b></h5>  <br />
        <p style="font-size: 12px;"><strong> {{$varios->nombre}}</strong> <br><br>
        <strong>NIT : </strong>  {{$varios->nit}}  <br>
        <strong>NCR : </strong>  {{$varios->ncr}}<br>
        <strong>GIRO : </strong> {{$varios->giro}}<br>
        <strong>Fecha / hora: </strong>{{$newDate = date("H:i d-m-Y", strtotime($corte->fecha_ejec))}} <br />
        <strong>Ticket #: </strong>  {{$corte->correlativo}} <br />
       
    <br>  

     <div class="lineas">  </div>
     <br>   

            @if ($corte->tipo_corte == 1)
                <b>  CORTE  DIARIO </b>
            @elseif ($corte->tipo_corte == 2)
                <b> CORTE  PARCIAL </b>
            @else
                <b>  CORTE  MENSUAL </b>
            @endif
        <br> 
       
        @if ($corte->fecha_inicio == $corte->fecha_fin )
            <P class= text-left>Fecha de corte: {{$newDate = date("d-m-Y", strtotime($corte->fecha_inicio))}} </P>
        @else
            <P class= text-left>Fecha de corte desde: {{$newDate = date("d-m-Y", strtotime($corte->fecha_inicio))}} <br> 
                Fecha de corte fin: {{$newDate = date("d-m-Y", strtotime($corte->fecha_fin))}} </P>
            
        @endif
 
    <div class="lineas2">  </div>
            <table class="outer-section2" border="0" width="100%" >
                <thead>
                <tr>
                        <th class="text-center" width="20%">Fecha </th>
                        <th class="text-center" width="15%">Número</th>
                        <th class="text-right"  width="10%">Total </th>
                    </tr>
                </thead>
                 
                <tbody>
                    @foreach($ventas as $ven)
                        <tr>
                            <td class= text-center>{{date('d-m H:i', strtotime($ven->fecha_hora))}}</td>
                            <td class= text-center>{{$ven->num_comprobante}}</td> 
                            <td class= text-right> 
                                @if ($ven->estado == 'Reporte')
                                    Reporte
                                @else
                                    {{number_format($ven->total_venta, 2, '.', ',')}}
                                @endif  
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>  
    <div class="lineas2">  </div>          
{{-- <br>  --}}

            <table class="outer-section3" border="0" width="70%" >
                <tbody>
                    <tr>
                        <td class= text-left width="40%">Ticket Inicio</td>
                        <td class= text-right width="10%">{{$resumen->menor}}</td>
                    </tr>

                    <tr>
                        <td class= text-left>Ticket Final</td>
                        <td class= text-right>{{$resumen->mayor}}</td>
                    </tr>

                    <tr>
                        <td class= text-left>V. Exentas</td>
                        <td class= text-right>{{number_format($exenta->exentas, 2, '.', ',')}}</td>
                   </tr>

                    <tr>     
                        <td class= text-left>V. N/S</td>
                        <td class= text-right>{{--$exenta->exentas--}}</td>
                    </tr>

                    <tr>
                        <td class= text-left>V. Gravadas</td>
                        <td class= text-right>{{$resumen->total_venta - $exenta->exentas}}</td>
                    </tr>

                    <tr>
                        <td class= text-left>Devoluciones</td>
                        <td class= text-right>{{number_format($devolucion->devolucion, 2, '.', ',')}}</td>
                    </tr>

                    <tr>
                        <td class= text-left>Total Ventas</td>
                        <td class= text-right>{{number_format($resumen->total_venta, 2, '.', ',')}}</td>
                    </tr>    
                </tbody>
            </table>

<br>            
        <div class="lineas">  </div>

<br>
   
       <p style="font-size:10px;"> {{$tienda->direccion}} <br>   
        N° de Res. {{$corte->numero_resolucion}} <br>
        Fecha de Resolución: {{$newDate = date("d-m-Y", strtotime($corte->fecha_resolucion))}} <br> 
        Serie: {{$corte->serie_resolucion}} <br>
        Rango: {{$corte->rango_desde .' - '. $corte->rango_hasta}} <br> </p>


        <br> <br><br> <br>
        
    </div> 

    <br> 
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa text-center"  id="">
            <div class="form-group">
                <input name="_token" value="{{csrf_token()}}" type="hidden" />

                    <a href="{{URL::action('CorteController@reimpresion', $corte->id_corte)}}">
                        <button class="btn btn-success btn-sm m-t-10"
                        >Reimpresión</button> </a>


                <a href="{{ url('/corte') }}"><button class="btn btn-primary btn-sm m-t-10"
                        type="button">Cancelar</button></a>
            </div>
        </div>
    </div>
</body 