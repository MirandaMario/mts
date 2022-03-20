


<table  border="0" width="95%">

  <tr>
{{--     <th  rowspan="2" > <img align="left" width="100" height="45" src="{{asset('imagenes/logo.png')}}"><br></th> --}}
    <th  colspan="5" style="font-size: 24px" align = "center">  {{ config('constantes.COMPANY') }}  </h4> 
</th>
  </tr>

  <tr>
    <td  colspan="5"  style="font-size: 14px" align = "center">{{ config('constantes.DIRECCION') }}</td>
  </tr>



  <tr style="font-size: 14px">
    
    <td   colspan="1"height="7%" valign="bottom" align="right" align="right" ><b>Recibo:</b>&nbsp;&nbsp;</td>
    <td   colspan="2" valign="bottom">{{$venta->num_comprobante}} </td>
    <td  colspan="3" width="10%" align="left" valign="bottom"><b>Fecha:</b> {{$newDate = date("d/m/Y", strtotime($venta->fecha_hora))}}</td>
  </tr>

  <tr  style="font-size: 14px">
    <td height="5%" width="10%" valign="top" align="right" colspan="1"><b>Nombre:</b> </td>
    <td width="60%" align="left" valign="top" colspan="2">{{$venta->nombre}} </td>
    
       
  </tr>
<tr>
    <td   align="left" colspan="6" valign="bottom"> <b> <hr> </b></td>
    

  </tr>
  <tr  style="font-size: 12px" >
    <td  align="left" colspan="1"> <b> CODIGO </b></td>
    <td  colspan="2" align="center" > <b>DESCRIPCION </b></td>
    <td  align="center" colspan="1" width="15%"> <b>CANTIDAD </b></td>
    <td  align="center" colspan="1" width="15%"> <b>PRECIO</b> </td>
    <td  align="right" colspan="1" width="25%"><b>TOTAL</b></td>

  
  <tr style="font-size: 13px" valign="top">
    <td colspan="1" height="70px" >@foreach($detalles as $det){{$det->codigo}}<br>@endforeach</td>
    <td colspan="2">@foreach($detalles as $det){{$det->articulo}}<br>@endforeach</td>
    <td colspan="1" align="center">@foreach($detalles as $det)&nbsp;&nbsp;&nbsp;{{$det->cantidad}} <br>@endforeach</td>
    <td colspan="1" class="text-rigth" align="right">@foreach($detalles as $det){{number_format($det->precio_venta,2)}}&nbsp;&nbsp;&nbsp;&nbsp;<br> @endforeach</td>
    <td colspan="1" align="right">@foreach($detalles as $det){{number_format($det->cantidad*$det->precio_venta,2)}}<br> @endforeach </td>
  </tr>

</tr>

<tr>
    <td   align="left" colspan="6" valign="bottom"> <b> <hr> </b></td>
    

  </tr>
 
  <tr style="font-size: 12px">
    <td colspan="5" align="right"><b>TOTAL: $ </b></td>
    <td align="right">{{$venta->total_venta}}</td>
  </tr>

  </tr>
<tr>
    <td   align="left" colspan="6" valign="bottom"> <b> <hr> </b></td>
    

  </tr>

</table>            

     
     <p align="center"> Firma y sello </p>
     <p align="right"> Original-Cliente </p>
     
     <hr>
   
 <br> 
<table  border="0" width="95%">

  <tr>
{{--     <th  rowspan="2" > <img align="left" width="100" height="45" src="{{asset('imagenes/logo.png')}}"><br></th> --}}
    <th  colspan="5" style="font-size: 24px" align = "center">  {{ config('constantes.COMPANY') }}  </h4> 
</th>
  </tr>

  <tr>
    <td  colspan="5"  style="font-size: 14px" align = "center">{{ config('constantes.DIRECCION') }}</td>
  </tr>



  <tr style="font-size: 14px">
    
    <td   colspan="1"height="7%" valign="bottom" align="right" align="right" ><b>Recibo:</b>&nbsp;&nbsp;</td>
    <td   colspan="2" valign="bottom">{{$venta->num_comprobante}} </td>
    <td  colspan="3" width="10%" align="left" valign="bottom"><b>Fecha:</b> {{$newDate = date("d/m/Y", strtotime($venta->fecha_hora))}}</td>
  </tr>

  <tr  style="font-size: 14px">
    <td height="5%" width="10%" valign="top" align="right" colspan="1"><b>Nombre:</b> </td>
    <td width="60%" align="left" valign="top" colspan="2">{{$venta->nombre}} </td>
  
       
  </tr>
<tr>
    <td   align="left" colspan="6" valign="bottom"> <b> <hr> </b></td>
    

  </tr>
  <tr  style="font-size: 12px" >
    <td  align="left" colspan="1"> <b> CODIGO </b></td>
    <td  colspan="2" align="center" > <b>DESCRIPCION </b></td>
    <td  align="center" colspan="1" width="15%"> <b>CANTIDAD </b></td>
    <td  align="center" colspan="1" width="15%"> <b>PRECIO</b> </td>
    <td  align="right" colspan="1" width="25%"><b>TOTAL</b></td>

  
  <tr style="font-size: 13px" valign="top">
    <td colspan="1" height="70px" >@foreach($detalles as $det){{$det->codigo}}<br>@endforeach</td>
    <td colspan="2">@foreach($detalles as $det){{$det->articulo}}<br>@endforeach</td>
    <td colspan="1" align="center">@foreach($detalles as $det)&nbsp;&nbsp;&nbsp;{{$det->cantidad}} <br>@endforeach</td>
    <td colspan="1" class="text-rigth" align="right">@foreach($detalles as $det){{number_format($det->precio_venta,2)}}&nbsp;&nbsp;&nbsp;&nbsp;<br> @endforeach</td>
    <td colspan="1" align="right">@foreach($detalles as $det){{number_format($det->cantidad*$det->precio_venta,2)}}<br> @endforeach </td>
  </tr>

</tr>

<tr>
    <td   align="left" colspan="6" valign="bottom"> <b> <hr> </b></td>
    

  </tr>
 
  <tr style="font-size: 12px">
    <td colspan="5" align="right"><b>TOTAL: $ </b></td>
    <td align="right">{{$venta->total_venta}}</td>
  </tr>

  </tr>
<tr>
    <td   align="left" colspan="6" valign="bottom"> <b> <hr> </b></td>
    

  </tr>

</table>              
   
     
     <p align="center"> Firma y sello </p>
     <p align="right"> Copia-Patucell </p>
   