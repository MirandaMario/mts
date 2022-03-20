
    {!! Form::open(array('url'=>'salida','method'=>'get','autocomplete'=>'off','role'=>'search', 
    "class"=>"form-inline")) !!}


        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        @if (auth()->user()->rol == 1)
        <a href='{{ route('salida.create')}}'> <span aria-hidden="true" class="glyphicon glyphicon-plus-sign" style="color:#FFFFFF; font-size: 20px;">
            </span>  </a>
        @endif
    </div>
    {{Form::close()}}