@extends('layouts.admin')
@section('title','Nuevo Artículo')
@section('contenido')
@include('almacen.modelo.create')
@include('almacen.categoria.create') 
@include('almacen.marca.create')

<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
@include('partial.error')
<div class="row" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Datos del nuevo artículo
            </div>
            <div class="panel-body">

                {!!Form::open(array('url'=>'articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
                {{Form::token()}}

                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
                        <div class="form-group">
                            <label for="nombre" class="apa">Nombre</label>
                            <input type="text" name="nombre" id="name" required value="{{old('nombre')}}" class="form-control"
                                placeholder="Nombre..." autofocus />
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6   pa">
                        <div class="form-group">
                            <label for="codigo" class="apa">Código</label>
                            <input type="text" name="codigo" id="codigo" required value="{{old('codigo')}}" class="form-control"
                                placeholder="Código..." />
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6  pa">
                        <div class="form-group">
                            <label>Marca</label>
                            <a href="" data-target="#formMarcaModal" data-toggle="modal">++</a>
                            <select name="marcas" id="marcas" class="form-control" required>
                                <option value="1" selected>Marca</option>
                                @foreach($marcas as $mar)
                                <option value="{{$mar->idMarca}}">
                                    {{$mar->nombreMarca}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6  pa">
                        <div class="form-group">
                            <label id="gitmodelo">Modelo
                            </label>
                            <a href="" data-target="#formModeloModal" data-toggle="modal">++</a>
                            <select name="idModelo" id="idModelo" class="form-control">
                                <option value="1" selected>Modelo</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label class="apa">Categoría
                             </label><a href="" data-target="#formCategoriaModal" data-toggle="modal">++</a>
                            <select name="idcategoria" id="idCategoria" class="form-control">
                                @foreach($categorias as $cat)
                                <option value="{{$cat->idcategoria}}">
                                    {{$cat->nombreCategoria}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label for="codBar" class="apa">Cod Bar</label>
                            <input type="text" name="codbar"  class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label for="tamano" class="apa">Size</label>
                            <input type="text" name="tamano"  id="tamano" value="{{old('tamano')}}" class="form-control"
                                placeholder="S, M, L/ 7, 8, 9" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label for="color" class="apa">Color</label>
                            <input type="text" name="color"  id="color" value="{{old('color')}}" class="form-control"
                                placeholder="Blanco" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label for="idioma" class="apa">Idioma</label>
                            <input type="text" name="idioma"  id="idioma" value="{{old('idioma')}}" class="form-control"
                                placeholder="Español" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
                        <div class="form-group">
                            <label for="descripcion" class="apa">Descripción</label>
                            <input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control"
                                placeholder="Descripción del artículo..." />
                            <input type="hidden" id="ivav" value="{{$varios->iva}}">
                            <input type="hidden" id="cescv" value="{{$varios->cesc}}">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-3 pa">
                        <div class="form-group">
                            <label for="minimo" class="apa">Mínimo</label>
                            <input type="number" name="minimo" required value="1" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-3 pa">
                        <div class="form-group">
                            <label for="maximo" class="apa">Máximo</label>
                            <input type="number" name="maximo" required value="5" class="form-control"/>

                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label for="precioCompra" class="apa">Costo producto</label>
                            <input type="number" min="0" step="0.01" name="costoProducto" id="costoProducto" required
                                value="{{old('costoProducto')}}" class="form-control pa" placeholder="0.00" />
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                        <div class="form-group">
                            <label class="apa">Exento &nbsp;&nbsp;&nbsp;&nbsp; </label>
                            <select name="exento" id="exento" class="form-control">
                                <option value="1" selected> NO </option>
                                <option value="0"> SI </option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="row ">
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
                                <input type="number" min="0" step="0.01" name="porcentaje" id="porcentaje" required
                                value="{{old('porcentaje')}}" class="form-control pa" placeholder="0.00" />
                            </td>
                            <td>
                                <input type="number" name="precio" id="vCalculado" class="form-control"
                                min="0" step="0.01"  value="0" />
                            </td>
                            <td>
                                <input type="text"  id="utilidad" class="form-control" readonly />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label class="pa">DETALLE2  </label>
                            </td>
                            <td>
                                <input type="number" min="0" step="0.01" name="porcentaje2" id="porcentaje2" 
                                value="{{old('porcentaje2')}}" readonly class="form-control pa" placeholder="0.00" />
                            </td>  
                            <td>
                                <input type="number" name="precio2" id="vCalculadoMayoreo" class="form-control"
                                min="0" step="0.01"  value="0"  />
                            </td>
                            <td>
                                <input type="text"  id="utilidad2" class="form-control" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="apa">MAYOREO</label>
                            </td>
                            <td>
                                <input type="number" min="0" step="0.01" name="porcentaje3" id="porcentaje3" 
                                value="{{old('porcentaje3')}}" readonly class="form-control pa" placeholder="0.00" />
                            </td>  
                            <td>
                                <input type="number" name="precio2" id="vCalculadoMayoreo3" class="form-control"
                                min="0" step="0.01" value="0"/>
                            </td>
                            <td>
                                <input type="text"  id="utilidad3" class="form-control" readonly />
                            </td>
                        </tr>
                       
                    </table>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                    <label for="imagen" class="apa">Imagen para miniatura  300PX</label>
                    <span></span>
                    <input type="file" name="imagen1" class="custom-file-input" id="imagen1" onchange="validarImagen(this);" /> <br>
                </div>
                <div id="uploadForm" class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-10 col-sm-10 col-md-10 col-xs-6 pa">
                        <div class="form-group">
                            <label  class="apa">Url Amigable</label>
                            <input type="text" name="slug" id="obtener" value="{{old('slug')}}" class="form-control" required placeholder="hacer click para obtener datos url limpia"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <div class="form-group">
                            <label class="apa">Tipo &nbsp;</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="0" selected> Articulo Comun </option>
                                <option value="1" > Articulo Externo </option>
                                <option value="2" > Servicio </option>
                                <option value="3" > Servicio Interno</option>
                            </select>
                        </div>
                    </div>
                </div>
                <BR>

                <div class="row  ">
                 {{--    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <label for="descripcion" class="apa">Publicado</label>
                        <div class="form-group pa">

                            <label class="radio-inline">
                                <input type="radio" name="publicado" value ="on" >SI
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="publicado" value ="off" checked>NO
                            </label>
                        </div>
                    </div> --}}
            {{--         <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 pa">
                        <label for="descripcion" class="apa">Precio Publico</label>
                        <div class="form-group pa">

                            <label class="radio-inline">
                                <input type="radio" name="ver_precio"  checked>SI
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ver_precio">NO
                            </label>
                        </div>
                    </div> --}}
                    <div id="botones" class="col-lg-4 col-sm-4 col-md-6 col-xs-12 pa pull-right">
                        <button class="btn btn-success btn-sm m-t-10" type="submit">GUARDAR</button>
                        <a href="{{ url('/articulo') }}"><button class="btn btn-primary btn-sm m-t-10"
                                type="button">CANCELAR</button></a>
                        <button class="btn btn-warning btn-sm m-t-10" type="reset" class="text-right">RESET</button>
                    </div>
                </div>
            </div>
        </div>
        {!!Form::close()!!}

        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover display compact" id="art" style="font-size:100%; width:100%;">
                        <thead>
                            <th class="text-left"  >ID</th>
                            <th class="text-center">Código</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Marca</th>
                            <th class="text-center">Modelo</th>
                            <th class="text-center">Categoría</th>
                            <th class="text-center">Estado</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($articulos as $art)
                            <tr>
                                <td class="text-center"><b> <a style="color:black;"
                                            href="{{URL::action('ArticuloController@show',$art->idarticulo)}}">
                                            {{ $art->idarticulo }}
                                    </b></a></td>
                                <td>{{$art->codigo}}</td>
                                <td>{{$art->nombre}}</td>
                                <td>{{$art->nombreMarca}}</td>
                                <td>{{$art->nombreModelo}}</td>
                                <td>{{$art->nombreCategoria}}</td>
                                <td class="text-center">{{$art->estado}}</td>
                                <td>
                                    <a href="{{URL::action('ArticuloController@show3',$art->idarticulo)}}">
                                        <span aria-hidden="true" class="glyphicon glyphicon-sunglasses"></span>  
                                    </a> &nbsp;&nbsp;
                                    <a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}">
                                        <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>
                                    </a> &nbsp;&nbsp;
                                    <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal">
                                        <span aria-hidden="true" class="glyphicon glyphicon-minus-sign"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/articulo/articulo.js')}}"></script>
@endsection