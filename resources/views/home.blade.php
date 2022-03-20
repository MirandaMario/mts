@extends('layouts.app')

@section('content')

<div class="container">

<ol colur="blue" class="breadcrumb">

    <li> <a href="{{ url('/articulo') }}">Articulos&nbsp;&nbsp;&nbsp;</a></li>
    <li> <a href="{{ url('/ingreso') }}">Compras&nbsp;&nbsp;&nbsp;</a></li>
    <li> <a href="{{ url('/venta') }}">Ventas&nbsp;&nbsp;&nbsp;</a></li>

</ol>

</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">DEVELOPER ver 0.2</div>



                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   Sesion iniciada !!!
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
