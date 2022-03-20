@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@php
//dd($marca);
@endphp
<div class="row" >
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title"> Editar marca : {{$marca->nombreMarca}}</h4>
            </div>
            <div class="panel-body">

                {!!Form::model($marca,['method'=>'PATCH','autocomplete'=>'off','route'=>["marca.update",$marca->idMarca], 'files'=>'true'] )!!}
                {{Form::token()}}
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">Nombre Marca</label>
                        <input type="text" name="nombreMarca" class="form-control" value="{{$marca->nombreMarca}}" placeholder="Nombre...">
                    </div>
                </div>
               {{--  <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                    <label for="imagen" class="apa">Imagen</label>
                    <input type="file" name="imagen1" class="custom-file-input" id="imagen1" /> <br>
                    <div id="uploadForm">
                        @if($marca->logo !="")
                        <img id="img" src="{{ asset("imagenes/logos/".$marca->logo)  }}"
                            height="200px" width="300px" />
                        @endif
                    </div>
                    <input type="hidden" name="img_original1" value="{{$marca->logo}}">
                </div> --}}
                <div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <br><br>
                        <button class="btn btn-success btn-sm m-t-10" type="submit">Guardar</button>

                        <a href="{{ url('/marca') }}"><button class="btn btn-primary btn-sm m-t-10"
                                type="button">Cancelar</button></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-warning btn-sm m-t-10" type="reset" align="right">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            $('#img').remove();
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img src="' + e.target.result + '"width="200" height="200"/>');
        }
    }
}

$("#imagen1").change(function () {
    filePreview(this);
});
</script>
@endsection