@extends('online.master')
@section('title','HACER PEDIDO')
@section('content')
<link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<!-- SECTION -->
<br>
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-6">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Datos de Pedido</h3>
                    </div>
                    {!!Form::open(array('url'=>'save','method'=>'POST','autocomplete'=>'on','files'=>'true', 'id'=>'checkout' ))!!}
                    {{Form::token()}}
                </div>

                @php
                try {
                      $dt =  auth('clients')->user()->nombre; 
                    } catch (\Exception $e) {
                    }
                @endphp

                @if(isset($dt))
                    <div class="input-group-icon mt-10">
                        <label for="">{{ strtoupper(auth('clients')->user()->nombre)}}</label>
                        <input type="hidden" class="single-input"  name="id_cliente" value="{{auth('clients')->user()->idpersona}}" readonly>
                        <input type="text" class="single-input"  name="email" value="{{auth('clients')->user()->email}}" readonly>
                        <input type="text" class="single-input"  value="{{auth('clients')->user()->direccion}}" readonly>
                        <input type="text" class="single-input"  value="{{auth('clients')->user()->tel}}" readonly>
                    </div>

                @else 
                    <div class="input-group-icon mt-10">
                        <label for="">Nombre</label>
                        <input type="text" class="single-input"  name="nombre"  required>
                        <label for="">E-mail</label>
                        <input type="email" class="single-input"  name="email" >
                        <label for="">Tel</label>
                        <input type="tel" class="single-input"  name="telefono" required>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="departamento">Departamento</label>
                                <select class="form-control" id="departamento" name="departamento" {{-- class="input2"  --}}>
                                    <option value=""></option>
                                    @foreach($departamentos as $dep)
                                    <option value="{{$dep->ID}}">{{$dep->DepName}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="municipio">Municipio</label>
                                <select class="form-control" name="id_municipio" id="id_municipio">
                                    <option value="214">San Salvador</option>
                                </select>
                            </div>
                        </div>
                       
                        <label for="">Direccion</label>
                        <textarea class="single-textarea" placeholder="Direccion"
                             rows="2" name="direccion" value="{{ old('direccion') }}"></textarea>
                    </div>
                @endif
             
                <div class="input-group-icon mt-10">
                    
                    <div class="order-notes"> <span aling=right id="contadorTaComentario">0/400 </span>
                        <textarea class="single-textarea" placeholder="Observaciones / puntos de referencia"
                            id="taComentario" rows="4" name="notas" value="{{ old('notas') }}"></textarea>
                    </div>
                    <br>
                </div>
            </div>
            <!-- Order Details -->
            <div class="col-md-6 order-details">
                @if(count(\Cart::getContent()) > 0)
                <div class="section-title text-center">
                    <h3 class="title">TU ORDEN</h3>
                </div>
                @php $suma = 0; @endphp

                @foreach(\Cart::getContent() as $item)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-lg-3  col-sm-3  col-xs-3">
                            <img src="{{ asset("imagenes/articulos/")}}/{{$item->attributes->image}}"
                                style="width: 50px; height: 50px;">
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <a  href="{{route('product',[$item->attributes->slug] )}}">{{$item->name}}</a>
                            <br><small>Cantidad: <span> {{$item->quantity}} </span></small>&nbsp; &nbsp;
                            @if ($item->attributes->desc > 0)
                            <small>Descuento: <span>- {{$item->attributes->desc}} %</span></small>
                            @endif
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-3">
                            <span>
                                <p>${{ \Cart::get($item->id)->getPriceSum() }}</p>
                            </span>
                        </div>
                        {{--    <hr> --}}
                    </div>
                </li>
                @endforeach
                <br>
                <div>
                    <div class="row" >
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <span>
                                 <a class="main_btn2 " href="{{route('cart') }}">
                                    EDITAR TU CARRITO 
                                </a>
                            </span>
                        </div>
                        
                        <div class="col-lg-6 col-sm-6">
                            <table class="table table-sm ">
                                <tr>
                                    <td class="text-right">Sub Total: $</td>
                                    <td class="text-right"> {{ \Cart::getTotal() }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Envio: $</td>
                                    <td class="text-right"> 1.99</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Total: $ </td>
                                    <td class="text-right" WIDTH="20%" >{{\Cart::getTotal()+1.99 }}
                                    <input type="hidden" name="total" value="{{\Cart::getTotal()+1.99 }}">
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                  
                    <div >
                        Costo por envio $1.99 en zona metroplitana S.S. y sus alredores, consultar por el costo fuera del area de S.S.
                    </div>
                </div>
                <br>
                {{--PAGO--}}

                <div>
                    <input type="radio" name="tipo_pago" value="r1" id="payment-1">
                    <label for="payment-1">
                        Pago contra entrega
                    </label>
                </div>

                <div>
                    <input type="radio" name="tipo_pago" value="r2" id="payment-2">
                    <label for="payment-2">
                        <span></span>
                        Transferencia Bancaria/Depósito
                    </label>
                </div>
                <hr>
                <div class="caption"  id="datos_pago">
           
                    <div class="row ">
                        <div class="col-lg-3 col-sm-3 ">
                            <span>
                                <label>Banco</label>
                            </span>
                        </div>

                        <div class="col-lg-9 col-sm-9 form-select">
                            <select class="form-control nup" name="id_banco">
                                <option value="1" selected> Solicitar cuenta bancaria por whatsapp, o facebook  7779 3876</option>
                                {{-- <option value="1" selected> Banco Agrícola 5450011530</option> --}}
                              {{--  <option value="2"> BAC 119710317</option>  --}}
                            </select>
                        </div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-lg-3 col-sm-3 ">
                            <span>
                                <label>Monto $</label>
                            </span>
                        </div>

                        <div class="col-lg-9 col-sm-9 ">
                            <span>
                                <input type="number" class="single-input" name="valor_transaccion"
                                    id="valor_transaccion" step="0.01" />
                            </span>
                        </div>
                        
                    </div>
                   {{--  <div class="row mt-10">
                        <div class="col-lg-3 col-sm-3">
                            <span>
                                <label name="nume_transaccion">N° Comprobante</label>
                            </span>
                        </div>

                        <div class="col-lg-9 col-sm-9">
                            <input type="text" class="single-input"  name="nume_transaccion" id="nume_transaccion" />
                        </div>
                    </div> --}}
                    <div class="row mt-10">
                        <div class="col-lg-3 col-sm-3">
                            <span>
                                <label for="check_in">Fecha</label>
                            </span>
                        </div>

                        <div class="col-lg-9 col-sm-9">
                            <span>
                                <input type="text" name="fecha_transaccion" {{-- class="datepicker"  --}} readonly="readonly"
                            value="{{$ldate = date('d-m-Y')}}" id="fecha" class="single-input text-center">
                            </span>
                        </div>
                    </div>
                 
                </div>
                <div class="input-checkbox mt-10" >
                    <input type="checkbox" id="terms" name="terms">
                    <label for="terms">
                        <span></span>
                        Acepto términos y condiciones
                    </label>
                </div>
                <br>
                <div class="p_icon">
                <div class="text-center">
                    <button class="main_btn"  type="submit" id="enviar"><i class="fa fa-paper-plane-o  add-to-cart-btn2"> Hacer pedido</i> </button>
                </div>
                
            </div>
            </div>
            <br>

            {!!Form::close()!!}

            <div class=text-center>
                <br>
                <a class="main_btn3" href="{{route('clearcart')}}" class="primary-btn2 text-center">LIMPIAR CARRITO</a>
                
            </div>
            
            @else
            <div class="text-center">
                <a href="{{route('/')}}" class="primary-btn2 text-center">Tu carro no tiene producto(s)</a>
            </div>
            @endif
            <br> <br> <br> <br>
        </div>
    </div>
</div>
</div>

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/check.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script>
    $( document ).ready(function() {

        $("#datos_pago").hide("fast"); 
        //$("div.desc").hide();
        $("input[name$='tipo_pago']").click(function() {
        var test = $(this).val();
        //console.log(test);
        if(test == "r2"){
            $("#datos_pago").show("slow");
        }else{
            $("#datos_pago").hide("slow"); 
        }
            
        });
    });

    $( "#checkout" ).submit(function( event ) {
        $('#espere_agregar').removeAttr("style");   
    });

    $('#departamento').change(function(){
        var query = $(this).val()*1; 
        if(query != '')
        {
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
        url:"{{route('online.municipio')}}",
        method:"POST",
        data:{query:query, _token: _token},
        success:function(data){

        var municipio;
          for (var i=0; i<data.length;i++)
            municipio+='<option value="'+data[i].ID+'">'+data[i].MunName+'</option>'
        $("#id_municipio").html(municipio);
       // $('select').niceSelect('update');
        }
        });
        }
    });
    
</script>
@endsection