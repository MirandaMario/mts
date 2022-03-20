@extends('layouts.admin')
@section('title','Estado Carro')
@section('contenido')

{{-- @php
    dump($datos)
@endphp --}}

@for ($i = 0; $i < count($datos); $i++)
    <br> <hr>
    @foreach ($datos[$i] as $item)
        @php
         echo  $item->id. '   ' . $item->name.'<br>' 
        @endphp 
    @endforeach 
@endfor 
 
<br><br>

       {{--  @php
         dump($datos2)
        @endphp  --}}
  
@endsection 