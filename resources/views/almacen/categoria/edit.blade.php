@extends('layouts.admin')
@section('title','Editar Categoria')
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
                    Editar registro   &nbsp;&nbsp; {{$categoria->nombreCategoria}}
                </div>
                <div class="panel-body">
                    {!!Form::model($categoria,['method'=>'PATCH','route'=>['categoria.update',$categoria->idcategoria],'files'=>'true', 'autocomplete' => 'off'])!!}
                    {{Form::token()}}

                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">Nombre</label>
                                <input type="text" name="nombreCategoria" class="form-control"  value="{{$categoria->nombreCategoria}}"/>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">Descuento</label>
                                <input type="number" name="descuento_cat" class="form-control" step="0.01" value="{{$categoria->descuento_cat}}"/>
                            </div>
                        </div>
                       {{--  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">Slug</label>
                                <input type="text" name="cslug" class="form-control" value="{{$categoria->cslug}}"/>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">Descripcion</label>
                                <input type="text" name="cdescripcion" class="form-control" value="{{$categoria->cdescripcion}}"/>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">H1</label>
                                <input type="text" name="ch1" class="form-control" value="{{$categoria->ch1}}"/>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">H2</label>
                                <input type="text" name="ch2" class="form-control" value="{{$categoria->ch2}}"/>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <label for="nombre" class="apa">Keyword</label>
                                <input type="text" name="ckeyword" class="form-control" value="{{$categoria->ckeyword}}"/>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <label  class="apa">CTEXTO</label>
                            <textarea  name="ctexto"  rows="10" cols="80">
                                {{$categoria->ctexto}}
                             </textarea>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12 pa pull-right">
                            <br><br><br>
                            <button class="btn btn-success btn-sm m-t-10" type="submit">ACTUALIZAR</button>
                            <a href="{{ url('/categoria') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a> <button class="btn btn-warning btn-sm m-t-10"
                                type="reset">RESET</button>
                        </div>
                    </div>
                {{--     <div class="row">
                        <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 pa">
                            <label for="imagen" class="apa">Imagen</label>
                            <input type="file" name="escritorio" class="custom-file-input" id="escritorio" /> <br>
                            <div id="uploadForm">
                                @if($categoria->escritorio !="")
                                <img id="img" src="{{ asset("imagenes/categorias/".$categoria->escritorio)}}"
                                    height="200px" width="600px" />
                                @endif
                            </div>
                            <input type="hidden" name="img_original1" value="{{$categoria->escritorio }}">
                        </div>

                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                            <label for="imagen" class="apa">Imagen dos</label>
                            <input type="file" name="movil" class="custom-file-input" id="movil" /> <br>
                            <div id="uploadForm2">
                                @if($categoria->movil  !="")
                                <img id="img2" src="{{ asset("imagenes/categorias/".$categoria->movil)  }}"
                                    height="200px" width="300px" />
                                @endif
                            </div>
                            <input type="hidden" name="img_original2" value="{{$categoria->movil}}">
                        </div>
                     
                    </div> --}}
        
        {!!Form::close()!!}
        <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
        <script src="{{asset('js/categoria/categoria.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
        <script> 
            CKEDITOR.replace( 'ctexto', { customConfig: '{{asset('js/myconfig.js')}}' } );
            $(document).ready(function(){
                $("#articulos").css("background-color", "orange");    
                });
        </script>

    </div>
</div>
</div>
</div>
@endsection {{--477--}}