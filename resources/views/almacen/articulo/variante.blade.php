@extends('layouts.admin')
@section('title','Variante')
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
                   Variantes  &nbsp;&nbsp;   **Se crean hijos de un artículo, los cuales heredarán todos los atributos del elemento padre  con ID {{$articulo->idarticulo}}
                </div>
                <div class="panel-body">
                    {!!Form::open(array('url'=>'create_variante','method'=>'POST','autocomplete'=>'off'))!!}
                    {{Form::token()}}

                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">Nombre</label>
                                <input type="text" name="nombre" id="name" required value="{{$articulo->nombre}}"
                                    class="form-control" readonly/>
                                    <input type="hidden" name="idarticulo" value="{{$articulo->idarticulo}}">
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="codigo" class="apa">Código</label>
                                <input type="text" name="codigo" id="codigo" required value="{{$articulo->codigo}}"
                                    class="form-control" readonly/>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">Marca</label>
                                <input type="text" name="marcas" id="marcas" required value="{{$articulo->nombreMarca}}"
                                class="form-control" readonly/>
                             
                               {{--  <select id="idMarca" name="marcas" class="form-control" readonly>
                                    <option value="{{$articulo->idMarca}}" selected> {{$articulo->nombreMarca}}</option>
                                    @foreach($marcas as $mar)
                                    <option value="{{$mar->idMarca}}">{{$mar->nombreMarca}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12  pa">
                            <div class="form-group">
                                <label>Modelo </label>
                                <input type="text" name="idModelo" id="idModelo" required value="{{$articulo->nombreModelo}}"
                                class="form-control" readonly/>
                               {{--  <select name="idModelo" id="idModelo" class="form-control" readonly>
                                    <option value="{{$articulo->idModelo}}" selected> {{$articulo->nombreModelo}}
                                    </option>
                                </select> --}}
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">Categoría</label>
                                <input type="text" name="idcategoria" required value="{{$articulo->nombreCategoria}}"
                                class="form-control" readonly/>
                               {{--  <select name="idcategoria" class="form-control" readonly>
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
                                </select> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label for="tamano" class="apa">Tamaño</label>
                                <input type="text" name="tamano" class="form-control"  value="{{$articulo->tamano}}"  readonly/>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label for="color" class="apa">Color</label>
                                <input type="text" name="color"  value="{{$articulo->color}}" class="form-control"  readonly/>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label for="idioma" class="apa">Idioma</label>
                                <input type="text" name="idioma"  value="{{$articulo->idioma}}"class="form-control"  readonly/>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label for="precioCompra" class="apa">Costo producto</label>
                                <input type="number" min="0" step="0.01" name="costoProducto" id="costoProducto"
                                    required value="{{$articulo->costoProducto}}" class="in form-control" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">Beneficio </label>
                                <input type="number" min="0" step="0.01" name="porcentaje" id="porcentaje"
                                    required value="{{$articulo->porcentaje}}" class="form-control" readonly />
                            </div>
                        </div>
                        @php $precio = precio($articulo, $varios ) @endphp

                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label for="vCalculado" class="apa">Precio</label>
                                <input type="number" name="precio" id="vCalculado" step="0.01" class="in form-control pa" min="0"
                                     placeholder="P. con porcentaje" value="{{number_format($precio[0], 2, '.', '')}}" readonly/>
                                <input type="hidden" id="ivav" value="{{$varios->iva}}">
                                <input type="hidden" id="cescv" value="{{$varios->cesc}}">
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label for="vCalculado" class="apa">P.ConDesc</label>
                                <input type="number"   class="in form-control pa" min="0" id="vCalculadoDesc"
                                    step="0.01" readonly placeholder="P. con porcentaje"value="{{number_format($precio[1], 2, '.', '')}}" readonly/>
                               
                            </div>
                        </div>
                     
                         <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">%DESC**</label>
                                <input type="number" min="0" step="1" name="descuento_art"  id="descuento_art" 
                                    required value="{{$articulo->descuento_art}}" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label class="apa">Utilidad</label>
                                <input type="number" min="0" step="1"   id="utilidad"  
                                value="{{number_format($precio[2], 2)}}" class="in form-control " readonly />
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12 pa">
                            <div class="form-group">
                                <label for="codBar" class="apa">Cod Bar</label>
                                <input type="text" name="codbar"  class="form-control" value="{{$articulo->codbar}}" readonly/>
                            </div>
                        </div>
    
                    </div> 
                
                    <hr>
                    

                 <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover"
                            style="font-size:100%;">
                            <thead style="background-color: #A9D0F5;">
                                <th>---</th>
                                <th>ID</th>
                                <th>Codigo </th>
                                <th>Color</th>
                                <th>Tamaño</th>
                                <th>Idioma</th>
                                <th>Cod Bar</th>
                            </thead>
                           
                            @foreach ($variantes as $det)
                            <tr class="selected">
                                <td></td>
                                <td>{{$det->idarticulo}}</td>
                                <td>{{$det->codigo}}</td>
                                <td>{{$det->color}}</td>
                                <td>{{$det->tamano}}</td>
                                <td>{{$det->idioma}}</td>
                                <td>{{$det->codbar}}</td>
                            </tr>
                           
                            @endforeach
                            
                        </table>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <button type="button" name="bt_add_v" id="bt_add_v" class="btn btn-primary ">
                                AGREGAR PARTE
                            </button>
                        </div>
                       **Las variantes son un articulo mas, por lo tanto no puden ser eliminadas &nbsp; 
                       **Aca no se pueden editar variantes &nbsp; 
                       **Solo pude crear variantes
                        <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12 pa pull-right">
                            <br><br><br>
                            <button class="btn btn-success btn-sm m-t-10" type="submit">CREAR VARIANTES</button>
                            <a href="{{ url('/articulo') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a> 
                        </div>
                    </div>
                    <br>
                    
                </div>
            </div>
        </div>
        {!!Form::close()!!}
        <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
        {{-- <script src="{{asset('js/articulo/articulo.js')}}"></script> --}}
    
       <script>
        $(document).ready(function(){
            $("#articulos").css("background-color", "orange");   
               $("#bt_add_v").click(function(){
                    agregar_v();
                   // $( "#codigo" ).focus();
               });
            });
        
            var cont=0;
            function agregar_v(){
               
                codigo = $("#codigo").val();
                 
                if(codigo!=""){
                        
                        var fila = '<tr class="selected" id="fila'+cont
                        +'"><td align="center"><button type="button" class="btn btn-warning btn-xs"  onclick="eliminar('+cont
                        +');">x</button></td><td></td><td><input type="text" name="codigo[]" value="'+codigo+'-">'
                        +'</td><td><input type="text" name="color[]" > </td> '
                        +'<td><input  name="tamano[]" ></td><td><input   name="idioma[]" ></td><td><input   name="codbar[]" ></td></tr>';
                        cont++;
        
                        limpiar();
                       
                        $('#detalles').append(fila);
                  
                }else{
                    alert("Error al ingresar la parte");
                }
            }
        
            function limpiar(){
                $("#nombre").val("");
                $("#descripcion").val("");
            }
        
            function eliminar(index){
                $("#fila"+index).remove();
            }
        
        </script>

    </div>
</div>
@endsection {{--477--}}