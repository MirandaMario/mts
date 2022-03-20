
    {!! Form::open(array('url'=>'articulo','method'=>'get','autocomplete'=>'off','role'=>'search', 'id'=>'formindex', 
    "class"=>"form-inline")) !!}
      
  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
  @if (auth()->user()->rol == 1)
  <a href='{{ route('articulo.create')}}' style="color: white; font-size: 20px;">+++</a>
  @endif
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  {{Form::token()}}

    <div class="form-group input-group-sm">
        <label>&nbsp;&nbsp;&nbsp;Marca&nbsp;&nbsp;&nbsp;</label>
        <select name="idMarca" class="form-control" style="font-family: Arial; font-size: 12pt;">
            <option value="%">Todas</option>
            @foreach($marcas as $mar)

            <option value="{{$mar->nombreMarca}}">
                {{$mar->nombreMarca}}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group input-group-sm">
        <label>&nbsp;&nbsp;&nbsp;Cat&nbsp;&nbsp;&nbsp;</label>
        <select name="idCategoria"  id="idCategoria" class="form-control"  style="font-family: Arial; font-size: 12pt;">
            <option value="%">Todas</option>
            @foreach($categorias as $cat)
            <option value="{{$cat->nombreCategoria}}">
                {{$cat->nombreCategoria}}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group input-group-sm">
        <label>&nbsp;</label>
        <input type="text" class="form-control" name="texto" id="articulo_index"  style="font-family: Arial; font-size: 15pt;">
        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}" /> --}}
    </div>
    <div class="form-group input-group-sm">
        <input type="hidden" name="buscar" id="buscar" value="buscar">

        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <button type="submit" class="btn btn-warning btn-sm">
            BUSCAR
        </button>
      
    </div>

    
    {{Form::close()}}
   