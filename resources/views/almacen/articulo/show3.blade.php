@extends('layouts.admin')
@section('title','Datos Artículo')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<div class="row" style="{{ config('constantes.FONT') }}">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">Datos artículo
            </div>
            <div class="panel-body">

                <br>
                <div class="col-md-4 pa">
                    <div class="table-responsive">
                        <table class="table table-bordered-striper table-hover table-responsive table-striped"
                            style="font-size:100%; width:80%;">
                            <tbody>
                                <tr>
                                    <td width="15%">NOMBRE</td>
                                    <td><b>{{strtoupper($articulo->nombre)}} </b></td>
                                </tr>
                                <tr>
                                    <td>CODIGO</td>
                                    <td><b>{{strtoupper($articulo->codigo)}} </b></td>
                                </tr>
                                <tr>
                                    <td>MARCA</td>
                                    <td><b>{{strtoupper($articulo->nombreMarca)}} </b></td>
                                </tr>
                                <tr>
                                    <td>MODELO</td>
                                    <td><b>{{strtoupper($articulo->nombreModelo)}} </b></td>
                                </tr>
                                <tr>
                                    <td>SIZE</td>
                                    <td><b>{{strtoupper($articulo->tamano)}} </b></td>
                                </tr>
                                <tr>
                                    <td>COLOR</td>
                                    <td><b>{{strtoupper($articulo->color)}} </b></td>
                                </tr>
                                <tr>
                                    <td>IDIOMA</td>
                                    <td><b>{{strtoupper($articulo->idioma)}} </b></td>
                                </tr>
                                <tr>
                                    <td>CATEGORÍA</td>
                                    <td><b>{{strtoupper($articulo->nombreCategoria)}} </b></td>
                                </tr>

                                <tr>
                                    <td>COSTO</td>
                                    <td><b>{{strtoupper($articulo->costoProducto)}} </b></td>
                                </tr>
                                <tr>
                                    <td>BENEFICIO</td>
                                    <td><b>{{strtoupper($articulo->porcentaje)}} % </b></td>
                                </tr>
                                <tr>
                                    <td>CESC</td>
                                    <td><b>{{$articulo->impuestodos == 1  ? 'SI' : 'NO' }}</b></td>
                                </tr>
                                <tr>
                                    <td>EXENTO</td>
                                    <td><b>{{$articulo->impuesto == 0  ? 'SI' : 'NO' }}</b></td>
                                </tr>
                                <tr>
                                    <td>DESCUENTO</td>
                                    <td><b>{{$articulo->descuento_art > 0  ?  $articulo->descuento_art : 0 }}</b></td>
                                </tr>
                              {{--   <tr>
                                    <td>PUBLICADO</td>
                                    <td><b>{{$articulo->publicado == 1  ?  'SI' : 'NO' }}</b></td>
                                </tr> 
                                <tr>
                                    <td>SLUG</td>
                                    <td><b>{{$articulo->slug}}</b></td>
                                </tr>--}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-5 pa">
                    <div class="table-responsive">
                        <table class="table table-bordered-striper table-hover table-responsive table-striped"
                            style="font-size:100%; ">
                            <thead>
                                <th>ID</th>
                                <th>TIENDA</th>
                                <th width="15%">MIN</th>
                                <th width="15%">MAX</th>
                                <th width="15%">STOCK</th>
                            </thead>
                            <tbody>
                                @foreach ($datostienda as $datos)
                                <tr>
                                    <td>{{$datos->idTienda}}</td>
                                    <td>{{$datos->nombreTienda}}</td>
                                    <td> {{$datos->min}}</td>
                                    <td> {{$datos->max}} </td>
                                    <td><b>{{$datos->stock}} </b></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5">
                                        <a href="{{URL::action('ArticuloController@edit',$articulo->idarticulo)}}">
                                            EDITAR
                                        </a>

                                    </td>
                                </tr>
                            {{--     <tr>
                                    <td colspan="5">
                                        <a href="{{route('product',[$articulo->slug] )}}"
                                            target="_blank">
                                            VER EN TIENDA
                                        </a>
                                    </td>
                                </tr>
                            --}}
                            </tbody>
                        </table>
                    </div>
                    <div >
                        <table>
                            <tr>
                                <td></td>
                                <td> <label class="apa">%Beneficio </label></td>
                                <td><label for="vCalculado" class="apa">Precio</label></td>
                                <td><label class="apa">Utilidad &nbsp;&nbsp;&nbsp;&nbsp; </label></td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="apa">DETALLE  </label>
                                </td>
                                <td>
                                    <input type="number" name="porcentaje" id="porcentaje" class="form-control pa" value="{{$articulo->porcentaje}}" readonly>
                                    <input type="hidden" name="cesc" id="cesc" value="0">
                                </td>
                                <td>
                                    @php $precio = precio($articulo, $varios ) @endphp
                                    <input type="number" name="precio" id="vCalculado" class="in form-control " min="0" step="0.01"
                                    placeholder="P. con porcentaje" value="{{number_format($precio[0], 2, '.', '')}}" readonly/>
                                    <input type="hidden" id="ivav" value="{{$varios->iva}}">
                                    <input type="hidden" id="cescv" value="{{$varios->cesc}}">
                                </td>
                                <td>
                                    
                                    <input type="number" min="0" step="1"   id="utilidad"  
                                    value="{{number_format($precio[2], 2)}}" class="in form-control " readonly />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="apa">DETALLE 2  </label>
                                </td>
                                <td>
                                    <input type="number" min="0" step="0.01" name="porcentaje2" id="porcentaje2" required
                                    value="{{$articulo->porcentaje2}}" readonly class="form-control pa" placeholder="0.00" />
                                </td>  
                                <td>
                                    
                                    <input type="number" name="precio2" id="vCalculadoMayoreo" class="form-control"
                                    min="0" step="0.01"  placeholder="P. con porcentaje"  value="{{number_format($precio[4], 2)}}" readonly/>
                                </td>
                                <td>
                                    <input type="text"  id="utilidad2" class="form-control" readonly  value="{{number_format($precio[3], 2)}}" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="apa">MAYOREO   &nbsp;&nbsp;&nbsp;&nbsp;</label>
                                </td>
                                <td>
                                
                                    <input type="number" min="0" step="0.01" name="porcentaje3" id="porcentaje3" required
                                    value="{{$articulo->porcentaje3}}" readonly class="form-control pa" placeholder="0.00" />
                                </td>  
                                <td>
                                    <input type="number" name="precio3" id="vCalculadoMayoreo3" class="form-control"
                                    min="0" step="0.01"  placeholder="P. con porcentaje"  value="{{number_format($precio[6], 2)}}" readonly/>
                                </td>
                                <td>
                                   
                                    <input type="text"  id="utilidad3" class="form-control" readonly  value="{{number_format($precio[5], 2)}}" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
               

                <div class="col-md-3 pa" style="text-align: center;">
                    <div>
                        <img class="card-img">
                        @if(($articulo->imagen1)!="")
                        <img src="{{ asset("imagenes/articulos/".$articulo->imagen1)  }}" height="200px"
                            width="200px" />
                        @endif
                    </div>
                    <br>
                    <div>
                        <img src="data:image/jpg;base64,{{base64_encode($barcode)}}" alt="{{$articulo->codigo}}"  style="width: 38mm; height:20mm" {{-- width="38mm" height="20mm" --}}><br>
                        <b>{{$articulo->codigo}} {{ $articulo->nombreMarca}} </b><br><b style="font-size: 9px">{{strtoupper($articulo->nombre)}} {{ $articulo->nombreModelo}} </b> 
                    </div>
                    <div>
                        @if (auth()->user()->rol == 1 )
                        <br>
                        <form class="form-contact contact_form" action="../vinetas" method="get"  target="_blank">
                            <div class="form-group col-md-6 pa">
                                <label for="">Cantidad</label>
                              <input type="number" class="form-control" name="cant" step="1" placeholder="Cantidad Etiquetas">
                              <input type="hidden" name="id" value="{{$articulo->idarticulo}}">
                            </div>
                            <div class="form-group col-md-6 pa">
                                <label for="">Espacio mm altura</label>
                                <input type="number" class="form-control" name="espacio" step="0.01" placeholder="Entre Etiquetas">
                            </div>
                            <div class="form-group col-md-6 pa">
                                <label for="">Columnas</label>
                                <select name="columna"  class="form-control">
                                    <option value="1" selected> 1 </option>
                                    <option value="2"> 2 </option>
    
                                </select>
                            </div>
                            <div class="form-group col-md-6 pa">
                                <label for="">Ancho mm entre Col.</label>
                                <input type="number" class="form-control" name="ancho" step="0.01" placeholder="Entre Etiquetas">
                            </div>
                            <div class="form-group col-md-6 pa">
                                <button type="submit" class="btn btn-default">Crear</button>
                            </div>
                           
                          </form>
                          @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <script>
        $(document).ready(function(){
        $("#articulos").css("background-color", "orange");    
        });
    </script>

    @endsection