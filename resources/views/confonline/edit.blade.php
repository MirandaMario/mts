@extends('layouts.admin')
@section('title','Conf OnLine')
@section('contenido')

{!!Form::model($confonline,['method'=>'PATCH','route'=>['confonline.update',$confonline->id_miscelanea],'files'=>'true', 'autocomplete' => 'off'])!!}
{{Form::token()}}


<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
        <label  class="apa">Envios</label>
        <textarea  name="envios"  rows="20" cols="80">
            {{$confonline->envios}}
         </textarea>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
        <label  class="apa">Terminos</label>
        <textarea  name="terminos"  rows="20" cols="80">
            {{$confonline->terminos}}
         </textarea>
    </div>
</div>
<hr>
<h4>Imágenes carrusel MOVIL  600*400 PX</h4>
<hr>
<div class="row">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <label for="imagen" class="apa">Imagen</label>
        <input type="file" name="imagen1" class="custom-file-input" id="imagen1" /> <br>
        <div id="uploadForm">
            @if($confonline->ct !="")
            <img id="img" src="{{ asset("imagenes/carrusel/".$confonline->ct)  }}"
                height="300px" width="300px" />
            @endif
        </div>
        <input type="hidden" name="img_original1" value="{{$confonline->ct}}">
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <label for="imagen" class="apa">Imagen dos</label>
        <input type="file" name="imagen2" class="custom-file-input" id="imagen2" /> <br>
        <div id="uploadForm2">
            @if($confonline->ct2 !="")
            <img id="img2" src="{{ asset("imagenes/carrusel/".$confonline->ct2)  }}"
                height="300px" width="300px" />
            @endif
        </div>
        <input type="hidden" name="img_original2" value="{{$confonline->ct2}}">
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <label for="imagen" class="apa">Imagen tres</label>
        <input type="file" name="imagen3" class="custom-file-input" id="imagen3" /> <br>
        <div id="uploadForm3">
            @if($confonline->ct3 !="")
            <img id="img3" src="{{ asset("imagenes/carrusel/".$confonline->ct3)  }}"
                height="300px" width="300px" />
            @endif
        </div>
        <input type="hidden" name="img_original3" value="{{$confonline->ct3}}">
    </div>
</div>
<br><br>
<h4>Imágenes carrusel PC   1920*500 PX </h4>
<br>
<div class="row">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <label for="imagen" class="apa">Imagen</label>
        <input type="file" name="imagen4" class="custom-file-input" id="imagen4" /> <br>
        <div id="uploadForm4">
            @if($confonline->cimagen !="")
            <img id="img4" src="{{ asset("imagenes/carrusel/".$confonline->cimagen)  }}"
                height="200px" width="400px" />
            @endif
        </div>
        <input type="hidden" name="img_original4" value="{{$confonline->cimagen}}">
        <div class="form-group">
            <label class="apa">Boton</label>
            <select name="url"  class="form-control">
                @foreach($categorias as $cat)
                <option value="{{$cat->cslug}}"        {{$confonline->url == $cat->cslug ? 'selected' : ''}}>
                    {{$cat->nombreCategoria}}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <label for="imagen" class="apa">Imagen</label>
        <input type="file" name="imagen5" class="custom-file-input" id="imagen5" /> <br>
        <div id="uploadForm5">
            @if($confonline->cimagen2 !="")
            <img id="img5" src="{{ asset("imagenes/carrusel/".$confonline->cimagen2)  }}"
                height="200px" width="400px" />
            @endif
        </div>
        <input type="hidden" name="img_original5" value="{{$confonline->cimagen2}}">
        <div class="form-group">
            <label class="apa">Boton</label>
            <select name="url2"  class="form-control">
                @foreach($categorias as $cat)
                <option value="{{$cat->cslug}}" {{$confonline->url2 == $cat->cslug ? 'selected' : ''}}>
                    {{$cat->nombreCategoria}}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
        <label for="imagen" class="apa">Imagen</label>
        <input type="file" name="imagen6" class="custom-file-input" id="imagen6" /> <br>
        <div id="uploadForm6">
            @if($confonline->cimagen3 !="")
            <img id="img6" src="{{ asset("imagenes/carrusel/".$confonline->cimagen3)  }}"
                height="200px" width="400px" />
            @endif
        </div>
        <input type="hidden" name="img_original6" value="{{$confonline->cimagen3}}">
        <div class="form-group">
            <label class="apa">Boton</label>
            <select name="url3"  class="form-control">
                @foreach($categorias as $cat)
                <option value="{{$cat->cslug}}" {{$confonline->url3 == $cat->cslug ? 'selected' : ''}}>
                    {{$cat->nombreCategoria}}
                </option>
                @endforeach
            </select>
        </div>
    </div>


</div>
<div class="col-lg-4 col-sm-4 col-md-6 col-xs-12 pa pull-right">
    <br><br><br>
    <button class="btn btn-success btn-sm m-t-10" type="submit">ACTUALIZAR</button>
    <a href="{{ url('/confonline') }}"><button class="btn btn-primary btn-sm m-t-10"
            type="button">CANCELAR</button></a> <button class="btn btn-warning btn-sm m-t-10"
        type="reset">RESET</button>
</div>

{!!Form::close()!!}
        <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
        <script src="{{asset('js/online/configuracion.js')}}"></script>
        <script>
            CKEDITOR.replace( 'envios', { customConfig: '{{asset('js/myconfig.js')}}' } );
            CKEDITOR.replace( 'terminos', { customConfig: '{{asset('js/myconfig.js')}}' } );
        </script>
@endsection