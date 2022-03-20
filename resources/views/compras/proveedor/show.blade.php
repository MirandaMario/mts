@extends('layouts.admin')
@section('title','Datos proveedor')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row" style=" {{ config('constantes.FONT') }}">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">Datos Proveedor
            </div>
                <div class="panel-body">
                       <table class="table table-bordered-striper table-hover table-responsive table-striped" style="font-size:100%; width:69;">
                        <tr>
                           <td width ="3%">NOMBRE</td>
                           <td width ="20%"><b>{{strtoupper($persona->nombre)}} </b></td>
                           <td width ="3%">ALIAS</td>
                           <td width ="20%"><b>{{strtoupper($persona->alias)}} </b></td>
                        </tr>

                        <tr>
                            <td >DIRECCION</td>
                            <td colspan="3"><b>{{strtoupper($persona->direccion)}} {{strtoupper($persona->MunName)}} {{strtoupper($persona->DepName)}} </b></td>
                        </tr>
                      
                       <tr>
                           <td >DUI</td>
                           <td ><b>{{strtoupper($persona->dui)}} </b></td>
                           <td >NIT</td>
                           <td ><b>{{strtoupper($persona->nit)}} </b></td>
                       </tr>
                      
                       <tr>
                           <td >REGISTRO</td>
                           <td ><b>{{strtoupper($persona->iva)}} </b></td>
                           <td >T. CONTRIBUYENTE</td>
                           <td ><b>{{strtoupper($persona->tipo_contribuyente)}} </b></td>
                       </tr>
                       <tr>
                            <td >PAGO</td>
                            <td ><b>{{strtoupper($persona->forma_pago)}} </b></td>
                            <td >ESTADO</td>
                           <td ><b>{{strtoupper($persona->estado)}} </b></td>
                           
                       </tr>
                      
                       <tr>
                            <td >GIRO</td>
                            <td colspan="3"><b>{{strtoupper($persona->giro)}} </b></td>
                       </tr>
                      
                    </table>
                    <table class="table table-bordered-striper table-hover table-responsive table-striped" style="font-size:100%; width:69;">
               
                       <tr>
                           <td width ="3%">CONTACTO 1</td>
                           <td width ="15%"><b>{{strtoupper($persona->contacto)}} </b></td>
                           <td width ="3%">TEL</td>
                           <td width ="5%"><b>{{strtoupper($persona->tel)}} </b></td>
                           <td width ="3%">EMAIL</td>
                           <td width ="18%"><b>{{strtoupper($persona->email)}} </b></td>
                       </tr>
                       <tr>
                           <td >CONTACTO 2</td>
                           <td><b>{{strtoupper($persona->contacto2)}} </b></td>
                           <td >TEL</td>
                           <td><b>{{strtoupper($persona->tel2)}} </b></td>
                           <td >EMAIL</td>
                           <td><b>{{strtoupper($persona->email2)}} </b></td>
                       </tr>
                       <tr>
                           <td >CONTACTO 3</td>
                           <td><b>{{strtoupper($persona->contacto3)}} </b></td>
                           <td >TEL</td>
                           <td><b>{{strtoupper($persona->tel3)}} </b></td>
                           <td >EMAIL</td>
                           <td><b>{{strtoupper($persona->email3)}} </b></td>
                       </tr>
                     </tbody>
                  </table>
                        </div>                                
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script> 
    $(document).ready(function(){
        $("#varios").css("color", "orange");
        });
</script>

@endsection
