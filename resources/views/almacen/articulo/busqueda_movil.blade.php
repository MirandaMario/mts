
{!! Form::open(array('url'=>'articulo','method'=>'get','autocomplete'=>'off','role'=>'search', 'id'=>'formindex',  "class"=>"form-inline")) !!}
  {{Form::token()}}
    <div class="form-group input-group-sm">
        @if (auth()->user()->rol == 1)
        <a href='{{ route('articulo.create')}}' style="color: white; font-size: 20px;">+++</a>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endif

        <input type="text"  name="texto" id="articulo_index" size="15" style="font-family: Arial; font-size: 15pt; color : black; ">
        <input type="hidden" name="buscar" id="buscar" value="buscar">
        
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <button type="submit" class="btn btn-warning btn-sm">
            BUSCAR
        </button>
    </div>
{{Form::close()}}
   