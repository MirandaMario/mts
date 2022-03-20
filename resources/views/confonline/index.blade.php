@extends('layouts.admin')
@section('title','Conf OnLine')
@section('contenido')

<ul>
    <li>
        <a href="{{URL::action('ConfOnlineController@create', [ "id" => "1"])}}">   <label for="">POLITICAS DE ENVIO E IMAGENES EN MODO MOVIL DE CARRUSEL</label> </a>
    </li>
</ul>




@endsection