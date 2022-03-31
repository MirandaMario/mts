{{-- @extends('layouts.admin')
@section('title','Datos cliente')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}"> --}}
<!DOCTYPE html>
<html lang="en" style="margin: 0px; ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EXPEDIENTE {{$expediente->numeroComprobante}}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap');
        @font-face { font-family: 'Roboto', sans-serif; }


        body { font-family: 'Roboto', sans-serif; font-size:12px; }        
  
      
             @page {
                margin: 0cm 0cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

                /** Estilos extra personales **/
                background-color: white;
                color: white;
                text-align: center;
                line-height: 1.5cm;
            }

            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0.5cm; 
                left: 0.5cm; 
                right: 0.5cm;
                height: 1.5cm;

                /** Estilos extra personales **/
                background-color:#8BA4D0;
                color: black;
                text-align: center;
                line-height: 1cm;
            }
    </style>
</head>
<body>
    <header> 
        <div align="left" style="padding: 1em 3px 0px 30px;"><img src="{{asset('imagenes/mt.jpg')}}" alt="texto alternativo" width="200" height="alto" style="padding-top: 8px"></div>
    </header>
  {{--   <footer>
        <div align="center"  style="padding: -10px 3px 0px 0px;"> <b> MTECH TIENDA DE INFORMATICA ON LINE </b> 
            <p style="padding: -30px 0px 0px 0px;"> {{config('constantes.pie_pagina_cotizacion') }} <a href="https://mtech-sv.com/" >mtech-sv.com</a>  </p>
        </div> 
    </footer> --}}
<main>
   <p align="center" style="font-size: 20px;"><b> DATOS INGRESO </b> </p> 

      <table border="0" width="100%" style="font-size:13px; border-collapse: collapse;" align="center" >
         <tr>
            <td width ="10%">Expediente</td>
            <td width ="10%"><b>{{strtoupper($expediente->numero_expediente)}} </b></td>
            <td width ="5%">Habitación</td>
            <td width ="5%"><b>{{strtoupper($expediente->habitacion)}} </b></td>
            <td width ="3%">DUI</td>
            <td width ="8%"><b>{{--strtoupper($expediente->numero_expediente)--}} 041152875 </b></td>
            <td width ="10%">F. Ing./Hora</td>
            <td width ="15%"><b>{{strtoupper($expediente->fecha_hora_ex)}}  </b></td>
         </tr>
 
         <tr>
            <td >Paciente</td>
            <td colspan="5"><b>{{strtoupper($expediente->id_paciente)}} </b></td>
            <td >Edad</td>
            <td ><b>{{strtoupper($expediente->fecha_hora_ex)}}  </b></td>
         </tr>

        <tr>
             <td >F. Nac. </td>
             <td colspan="2"><b>{{strtoupper($expediente->id_paciente)}} </b></td>
             <td colspan="2">Tel. casa</td>
             <td ><b>{{strtoupper($expediente->numero_expediente)}} </b></td>  
             <td >Cel.</td>
             <td ><b>{{strtoupper($expediente->numero_expediente)}} </b></td>  
          </tr>

           <tr>
             <td >Domicilio </td>
             <td colspan="7"><b>{{strtoupper($expediente->id_paciente)}} </b></td>
         </tr>

         <tr>
             <td >Responsable </td>
             <td colspan="3"><b>{{strtoupper($expediente->id_paciente)}} </b></td>
             <td >Tel.</td>
             <td ><b>{{strtoupper($expediente->numero_expediente)}} </b></td>  
             <td >Cel.</td>
             <td ><b>{{strtoupper($expediente->numero_expediente)}} </b></td>  
          </tr> 
      </table>

   <p align="center" style="font-size: 15px;"><b> DATOS PARA ASEGURADORA </b> </p> 
     
   <table border="0" width="100%" style="font-size:13px;  border-collapse: collapse;" align="center">
      <tr>
         <td width ="15%"><b>Empresa</b></td>
         <td colspan="3">{{$expediente->empresa}}</td>
      </tr>

      <tr>
          <td ><b>Asegurado</b></td>
          <td >{{$expediente->asegurado_principal}}</td>
          <td width ="10%"><b>Carnet n°</b></td>
          <td width ="10%">{{$expediente->carnet}}</td>
       </tr>
      
       <tr>
          <td ><b>Dpto. o dep.</b></td>
          <td >{{$expediente->dependecia}} </td>
          <td ><b>Poliza</b></td>
          <td >{{$expediente->poliza}} </td>
       </tr>


      <tr>
          <td ><b>Dx de ingreso</b></td>
          <td >{{$expediente->dx_ingreso}} </td>
          <td ><b>Poliza</b></td>
          <td >{{$expediente->dx_codigo}} </td>
       </tr>
      
       <tr>
          <td ><b>Formularios</b></td>
          <td colspan="3">{{$expediente->fomulario}}</td>
       </tr>

       <tr>
          <td ><b>Car. no cubiertos</b></td>
          <td colspan="3">{{$expediente->cargo_no_cub}} </td>
       </tr>

        <tr>
          <td ><b>Tipo ingreso</b></td>
          <td colspan="3">{{$expediente->tipo_ing}} </td>
          
       </tr>

       <tr>
         <td ><b>Ingreso hecho</b></td>
         <td colspan="3">{{$expediente->ing_por}} </td>
      </tr>

       <tr>
          <td ><b>Eventos ingreso</b></td>
          <td colspan="3">{{$expediente->even_ing}} </td>
       </tr> 
  </table>

  <p align="center" style="font-size: 15px;"><b> DEJA RECIBO DE HONORARIOS EN CAJA </b> </p>

   <table border="1" width="100%" style="font-size:13px;  border-collapse: collapse;" align="center">
                                   
      <tr>
         <td colspan="2" align="center">Nombres de los médicos que han asistido a tratar al paciente </td>
         <td colspan="1" align="center">SI</td>
         <td colspan="1" align="center">NO</td>

      </tr>

      <tr>
         <td width ="5%" >1</td>
         <td width ="70%">{{$expediente->dr}}</td>
         <td width ="10%"></td>
         <td width ="10x%"></td>
      </tr>

      <tr>
         <td>2</td>
         <td >{{$expediente->dr2}}</td>
         <td ></td>
         <td ></td>
      </tr>

      <tr>
         <td>3</td>
         <td >{{$expediente->dr3}}</td>
         <td ></td>
         <td ></td>
      </tr>

      <tr>
         <td>4</td>
         <td >{{$expediente->dr4}}</td>
         <td ></td>
         <td ></td>
      </tr>

      <tr>
         <td>5</td>
         <td >{{$expediente->dr5}}</td>
         <td ></td>
         <td ></td>
      </tr>

      <tr>
         <td>6</td>
         <td >{{$expediente->dr6}}</td>
         <td ></td>
         <td ></td>
      </tr>

      <tr>
         <td>7</td>
         <td >{{$expediente->dr7}}</td>
         <td ></td>
         <td ></td>
      </tr>
   </table>

   <p align="center" style="font-size: 15px;"><b>DATOS PARA EGRESO </b> </p>

   <table border="0" width="100%" style="font-size:13px;  border-collapse: collapse;" align="center">

        
      <tr>
         <td width = "20%"><b>F. Alta</b></td>
         <td colspan="5" >{{$expediente->fecha_hora_alta}} </td>
         
      </tr>

      <tr>
         <td ><b>DX ppal de egreso</b></td>
         <td colspan="5" >{{$expediente->dx_egreso}} </td>
      </tr>
      
      <tr>
          <td ><b>O. Diagn.</b></td>
          <td colspan="5">{{$expediente->otros_diag}} </td>
      </tr>


      <tr>
         <td ><b>Int.Quir.</b></td>
         <td colspan="5">{{$expediente->inter_qui}} </td>
      </tr>

       <tr>
         <td ><b>Cond. Egreso </b></td>
         <td colspan="5">
            @if ($expediente->cond_egre == '6')
               N/A
                
               @elseif($expediente->cond_egre == '1' )
                Curado
               
               @elseif($expediente->cond_egre == '2' )
                Mejorado

                @elseif($expediente->cond_egre == '3' )
                Igual

                @elseif($expediente->cond_egre == '4' )
                Pac. pide alta

                @else
                Fallecido   
            @endif
            
         </td>
         {{-- <td >Aut. medica de egreso f. </td>
         <td >_____________________ </td>   --}}                          
      </tr>

      <tr>
         <td colspan="2"><b>Aut. médica egreso f.</b></td>
         <td >___________ </td> 
         <td ><b>Enf. Res.</b></td>
         <td colspan="3"> {{$expediente->enf_resp}}</td>
      </tr>

      <tr>
         <td ><b>Observ. Egreso</b></td>
         <td colspan="5">{{$expediente->obs_egre}} </td>
     </tr>

         
     <tr>
         <td colspan="2"><b>H. Farm.:</b> {{$expediente->hora_far}}</td>
         {{-- <td >{{strtoupper(($expediente->hora_far))}} </td> --}}
         <td colspan="2"><b>H. Tel.:</b> {{$expediente->hora_tel}}</td>
         {{-- <td >{{strtoupper(($expediente->hora_tel))}} </td> --}}
         <td colspan="2"><b>H. Caja:</b> {{$expediente->hora_caj}}</td>
  {{--        <td >{{strtoupper(($expediente->hora_caj))}} </td> --}}
      </tr>

      <tr>
         <td ><b>Se recibe pagaré</b></td>
         <td colspan="3">{{$expediente->rec_paga}} </td>
         <td ><b>Firma</b></td>
         <td >___________ </td>
      </tr>
   </table>
                                                                   
</main>
</body>





                    
        