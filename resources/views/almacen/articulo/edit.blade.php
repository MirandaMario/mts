@extends('layouts.admin')
@section('title','Editar Artículo')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('partial.error')
<style>
.in{
    background-color:black !important; color:chartreuse; font-size: 25px; 
}

</style>
<div class="row">
    <div>
        <div class="col-md-12 pa">
            <div class="panel panel-primary">
                <div class="panel-heading" style="font-size:150%; height: 40px;">
                    Editar registro
                </div>
                <div class="panel-body">
                    {!!Form::model($articulo,['method'=>'PATCH','route'=>['articulo.update',$articulo->idarticulo],'files'=>'true', 'autocomplete' => 'off'])!!}
                    {{Form::token()}}

                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">Nombre</label>
                                <input type="text" name="nombre" id="name" required value="{{$articulo->nombre}}"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label for="codigo" class="apa">Código</label>
                                <input type="text" name="codigo" required value="{{$articulo->codigo}}"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label class="apa">Marca</label>
                                <select id="idMarca" name="marcas" class="form-control">
                                    <option value="{{$articulo->idMarca}}" selected> {{$articulo->nombreMarca}}</option>
                                    @foreach($marcas as $mar)
                                    <option value="{{$mar->idMarca}}">{{$mar->nombreMarca}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6  pa">
                            <div class="form-group">
                                <label>Modelo </label>
                                <select name="idModelo" id="idModelo" class="form-control">
                                    <option value="{{$articulo->idModelo}}" selected> {{$articulo->nombreModelo}}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label class="apa">Categoría</label>
                                <select name="idcategoria" class="form-control">
                                    @foreach($categorias as $cat)
                                    @if($cat->idcategoria == $articulo->idcategoria)
                                    <option value="{{$cat->idcategoria}}" selected>
                                        {{$cat->nombreCategoria}}
                                    </option>
                                    @else
                                    <option value="{{$cat->idcategoria}}">
                                        {{$cat->nombreCategoria}}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label for="tamano" class="apa">Size</label>
                                <input type="text" name="tamano"  class="form-control" value="{{$articulo->tamano}}" />
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label for="color" class="apa">Color</label>
                                <input type="text" name="color"  class="form-control" value="{{$articulo->color}}" />
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label for="idioma" class="apa">Idioma</label>
                                <input type="text" name="idioma"  class="form-control" value="{{$articulo->idioma}}" />
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label for="codBar" class="apa">Cod Bar</label>
                                <input type="text" name="codbar"  class="form-control" value="{{$articulo->codbar}}" />
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label class="apa">Destacado &nbsp;&nbsp;&nbsp;&nbsp; </label>
                                <select name="destacado" id="destacado" class="form-control">
                                    @if ($articulo->destacado == 1)
                                    <option value="1" selected> SI </option>
                                    <option value="0"> NO </option>
                                    @else
                                    <option value="0" selected> NO </option>
                                    <option value="1"> SI </option>
                                    @endif
                                </select>
                            </div>
                        </div>  
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label class="apa">Tipo &nbsp;</label>
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="0" {{$articulo->tipo == 0 ? 'selected' : ''}}> Articulo Comun </option>
                                    <option value="1" {{$articulo->tipo == 1 ? 'selected' : ''}}> Articulo Externo </option>
                                    <option value="2" {{$articulo->tipo == 2 ? 'selected' : ''}}> Servicio </option>
                                    <option value="3" {{$articulo->tipo == 3 ? 'selected' : ''}}> Servicio Interno</option>
                                </select>
                            </div>
                        </div>         
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <div class="form-group">
                                <label for="precioCompra" class="apa">Costo producto</label>
                                <input type="number" min="0" step="0.01" name="costoProducto" id="costoProducto"
                                    required value="{{$articulo->costoProducto}}" class="in form-control" />
                            </div>
                        </div>
                        {{-- <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">CESC &nbsp;</label>
                                <select name="cesc" id="cesc" class="form-control">
                                    @if ($articulo->impuestodos == 1)
                                    <option value="1" selected> SI </option>
                                    <option value="0"> NO </option>
                                    @else
                                    <option value="1"> SI </option>
                                    <option value="0" selected> NO </option>
                                    @endif
                                </select>
                            </div>
                        </div> --}}
                        @php $precio = precio($articulo, $varios ) @endphp
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-6 pa">
                            <div class="form-group">
                                <label for="vCalculado" class="apa">P.ConDesc</label>
                                <input type="number"   class="in form-control pa" min="0" id="vCalculadoDesc"
                                    step="0.01" readonly placeholder="P. con porcentaje"value="{{number_format($precio[1], 2, '.', '')}}" />
                               
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-6 pa">
                            <div class="form-group">
                                <label class="apa">Exento &nbsp;&nbsp;&nbsp;&nbsp; </label>
                                <select name="exento" id="exento" class="form-control">
                                    @if ($articulo->impuesto == 1)
                                    <option value="1" selected> NO </option>
                                    <option value="0"> SI </option>
                                    @else
                                    <option value="1"> NO </option>
                                    <option value="0" selected> SI </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                         <div class="col-lg-1 col-sm-1 col-md-1 col-xs-6 pa">
                            <div class="form-group">
                                <label class="apa">%DESC**</label>
                                <input type="number" min="0" step="1" name="descuento_art"  id="descuento_art" 
                                    required value="{{$articulo->descuento_art}}" class="form-control" />
                            </div>
                        </div>
                   {{--      <div class="col-lg-1 col-sm-1 col-md-1 col-xs-6 pa">
                            <label for="descripcion" class="apa">Publicado</label>
                            <div class="form-group pa">
                                @if($articulo->publicado == 1 )
                                <label class="radio-inline">
                                    <input type="radio" name="publicado" value ="on" checked>SI
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="publicado" value ="off">NO
                                </label>
                                @else
                                <label class="radio-inline">
                                    <input type="radio" name="publicado"  value ="on">SI
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="publicado" value ="off"checked>NO
                                </label>

                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                            <label for="descripcion" class="apa">Precio Publico</label>
                            <div class="form-group pa">
                                @if($articulo->ver_precio == 1 )
                                <label class="radio-inline">
                                    <input type="radio" name="ver_precio"  value ="on" checked>SI
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="ver_precio" value ="off">NO
                                </label>
                                @else
                                <label class="radio-inline">
                                    <input type="radio" name="ver_precio"  value ="on">SI
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="ver_precio" value ="off" checked>NO
                                </label>
                                @endif
                            </div>
                        </div> --}}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
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
                                    <input type="hidden" name="cesc" id="cesc" value="0">
                                    <input type="text" name="porcentaje" id="porcentaje" class="form-control" value="{{$articulo->porcentaje}}">
                                </td>
                                <td>
                                    @php $precio = precio($articulo, $varios ) @endphp
                                    <input type="number" name="precio" id="vCalculado" class="in form-control pa" min="0" step="0.01"
                                    placeholder="P. con porcentaje" value="{{number_format($precio[0], 2, '.', '')}}"/>
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
                                    min="0" step="0.01"  placeholder="P. con porcentaje"  value="{{number_format($precio[4], 2)}}" />
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
                                    min="0" step="0.01"  placeholder="P. con porcentaje"  value="{{number_format($precio[6], 2)}}" />
                                </td>
                                <td>
                                   
                                    <input type="text"  id="utilidad3" class="form-control" readonly  value="{{number_format($precio[5], 2)}}" />
                                </td>
                            </tr>
                        </table>
                    </div> 
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                        <label for="imagen" class="apa">Miniatura</label>
                        <input type="file" name="imagen5" class="custom-file-input" id="imagen5" /><br>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                        <div id="uploadForm5">
                            @if($articulo->imagen5 !="")
                            <img id="img5" src="{{ asset("imagenes/articulos/".$articulo->imagen5)  }}"
                                height="200px" width="300px" />
                            @endif
                        </div>
                        <input type="hidden" name="img_original5" value="{{$articulo->imagen5}}">
                    </div>  
                </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <label  class="apa">Url Amigable</label>
                                <p>{{$articulo->slug}}</p>
                                <input type="hidden" name="slug" id="obtener" value="{{$articulo->slug}}" class="form-control" required placeholder="hacer click para obtener datos url limpia"/>
                            </div>
                        </div> 
                        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12 pa">
                         {{--    <label  class="apa">  <a href="{{route('producto',['id' =>  $articulo->idarticulo] )}}"
                                target="_blank">
                                VER EN TIENDA
                            </a></label> --}}

                            @if ($articulo->variantede == null || $articulo->variantede < 0 ) 
                            <label  class="apa">  <a href="{{route('variante',['id' =>  $articulo->idarticulo] )}}"
                                target="_blank">
                                VARIANTE
                            </a></label>
                                
                            @else
                                
                            @endif

                           

                            
                            <p>**El  porcetanje de descuento puesto aca estará sobre el descuento global asignado en la categoría <br>
                                **Al costo de producto primero se le agragarán los impuestos (IVA CESC) y luego el Beneficio  </p>
                        </div>   
                    </div>


                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <label  class="apa">Etiqueta</label>
                                <input type="text" name="etiqueta"  value="{{$articulo->etiqueta}}" class="form-control"/>
                            </div>
                        </div>
                    </div>
             {{--           <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <label  class="apa">DES SF</label>
                            <textarea  name="des_sf" class="form-control pa"  rows="2" cols="80">{{$articulo->des_sf}}</textarea>
                        </div>
                    </div>
                 <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <label for="hoja_tecnica" class="apa">Hoja Tecnica</label>
                            <input type="file" name="hoja_tecnica" class="custom-file-input"  /> 
                            <input type="text" name="hoja_original" class="in form-control" value="{{$articulo->hoja_tecnica}}">
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="puntos" class="apa">Puntos</label>
                                <input type="number" name="puntos" required value="{{$articulo->puntos == null ? '0' : $articulo->puntos}}"
                                     class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="premio" class="apa">Premio</label>
                                <input type="premio" name="premio" required value="{{$articulo->premio == null ? '0' : $articulo->premio}}"
                                     class="form-control" />
                            </div>
                        </div>
                    </div> --}}

                

                    <hr>
                    @php
                        $n = "1"; 
                    @endphp
                 {{--    <div class="row">
                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                            <label for="imagen" class="apa">Imagen</label>
                            <input type="file" name="imagen1" class="custom-file-input" id="imagen1" /> <br>
                            <div id="uploadForm">
                                @if($articulo->imagen1 !="")
                                <img id="img" src="{{ asset("imagenes/articulos/".$articulo->imagen1)  }}"
                                    height="200px" width="300px" />
                                @endif
                            </div>
                            <input type="hidden" name="img_original1" value="{{$articulo->imagen1}}">
                        </div>

                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                            <label for="imagen" class="apa">Imagen dos</label>
                            <input type="file" name="imagen2" class="custom-file-input" id="imagen2" /> <br>
                            <div id="uploadForm2">
                                @if($articulo->imagen2 !="")
                                <img id="img2" src="{{ asset("imagenes/articulos/".$articulo->imagen2)  }}"
                                    height="200px" width="300px" />
                                @endif
                            </div>
                            <input type="hidden" name="img_original2" value="{{$articulo->imagen2}}">
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                            <label for="imagen" class="apa">Imagen tres</label>
                            <input type="file" name="imagen3" class="custom-file-input" id="imagen3" /> <br>
                            <div id="uploadForm3">
                                @if($articulo->imagen3 !="")
                                <img id="img3" src="{{ asset("imagenes/articulos/".$articulo->imagen3)  }}"
                                    height="200px" width="300px" />
                                @endif
                            </div>
                            <input type="hidden" name="img_original3" value="{{$articulo->imagen3}}">
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                            <label for="imagen" class="apa">Imagen cuatro</label>
                            <input type="file" name="imagen4" class="custom-file-input" id="imagen4" /><br>
                            <div id="uploadForm4">
                                @if($articulo->imagen4 !="")
                                <img id="img4" src="{{ asset("imagenes/articulos/".$articulo->imagen4)  }}"
                                    height="200px" width="300px" />
                                @endif
                            </div>
                            <input type="hidden" name="img_original4" value="{{$articulo->imagen4}}">
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <br>
                            <table class="table table-hover">
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
                                        <td> <input type="hidden" name="idst[]"
                                                value="{{$datos->id_stocktienda}}">{{$datos->id_stocktienda}}</td>
                                        <td> <input type="hidden" name="idTienda[]"
                                                value="{{$datos->idTienda}}">{{$datos->nombreTienda}}</td>
                                        <td> <input type="number" size="2" class="form-control input-sm" name="min[]"
                                                value="{{$datos->min}}"> </td>
                                        <td> <input type="number" size="2" class="form-control input-sm" name="max[]"
                                                value="{{$datos->max}}"> </td>
                                        <td> <input type="number" size="2" class="form-control input-sm" name="stock[]"
                                                value="{{$datos->stock}}"> </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12 pa pull-right">
                            <br><br><br>
                            <button class="btn btn-success btn-sm m-t-10" type="submit">ACTUALIZAR</button>
                            <a href="{{ url('/articulo') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a> <button class="btn btn-warning btn-sm m-t-10"
                                type="reset">RESET</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">Descripción</label>
                                <textarea   name="descripcion"  rows="2" cols="80">
                                    {{$articulo->descripcion}}
                                </textarea>
                            </div>
                        </div>
                    </div>
               {{--      <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <label  class="apa">Detalles</label>
                            <textarea  name="detalles"  rows="10" cols="80">
                                {{$articulo->detalles}}
                             </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <label  class="apa">Video</label>
                            <textarea  name="urivideo" class="form-control pa"  rows="5" cols="80">
                                {{$articulo->urivideo}}
                             </textarea>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        {!!Form::close()!!}
        <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
        <script src="{{asset('js/articulo/articulo.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'descripcion', { customConfig: '{{asset('js/myconfig.js')}}' } );
            CKEDITOR.replace( 'detalles', { customConfig:  '{{asset('js/myconfig.js')}}' } );
        </script>
    </div>
</div>
@endsection {{--477--}}