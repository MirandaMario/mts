@extends('layouts.admin')
@section('title','Reporte Artículos')
@section('contenido')

<div class="panel panel-primary" >

    <div class="panel-heading">

        <p class="panel-title" > Ingresar criterios de búsqueda para reporte de
            artículos</p>
    </div>

    <div class="panel-body">
        {!! Form::open(array('url'=>'articulo/rapdf','method'=>'get','autocomplete'=>'off','role'=>'search', 'target'=>'_blank', )) !!}

        <div class="table-responsive">
            <table class="table table-bordered-striper table-hover table-responsive table-striped"
                style="font-size:100%; width:100%;">
                <tr>
                    <td>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <label>Palabra Clave</label>
                            <input type="text" name="texto" id="valorNominal"  class="form-control" />
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                                <label>Marca</label>
                                <select name="idMarca" class="form-control">
                                    <option value="%">Todas</option>
                                    @foreach($marcas as $mar)

                                    <option value="{{$mar->idMarca}}">
                                        {{strtoupper($mar->nombreMarca)}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                                <label>Categoría</label>
                                <select name="idCategoria" class="form-control">
                                    <option value="%">Todas</option>
                                    @foreach($categorias as $cat)
                                    <option value="{{$cat->idcategoria}}">
                                        {{$cat->nombreCategoria}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="estado" class="form-control">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>


                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-check">
                                <label class="form-check-label" for="defaultCheck1">
                                    Stock en cero &nbsp;&nbsp;&nbsp;
                                </label>
                                <select name="cero" class="form-control">
                                    <option value="No">NO</option>
                                    <option value="Si">SI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-check">
                                <label class="form-check-label" for="defaultCheck1">
                                    Beneficio  &nbsp;&nbsp;&nbsp;
                                </label>
                                <select name="beneficio" class="form-control">
                                    <option value="No">NO</option>
                                    <option value="Si">SI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                                <label></label>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><button type="submit" class="btn btn-primary">
                            Buscar
                        </button>
                    </td>
                </tr>
            </table>

        </div>
    </div>
</div>
{{Form::close()}}
@endsection
