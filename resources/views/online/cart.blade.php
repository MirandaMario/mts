@extends('online.master')
@section('title','CARRITO DE COMPRAS')

@section('content')
<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-lg-8 col-sm-12 col-md-8 col-xs-12">
            @if(\Cart::getTotalQuantity()>0)
            <h4 class="text-center"> <span class="text-center cpa">{{ \Cart::getTotalQuantity()}}</span> Producto(s) en
                tu carro</h4><br>
            @else
            <h4 class="text-center">No hay producto(s) en tu carro</h4><br>
            <a href="{{route('/')}}" class="main_btn2">Continuar comprando</a>
            @endif
            @foreach($cartCollection as $item)
            <div class="row text-center">
                <div class="col-lg-3  col-md-3  col-sm-4 col-xs-4">
                    <img src="{{asset("imagenes/articulos/")}}/{{$item->attributes->image}}" class="img-thumbnail"
                        width="200" height="200">
                </div>
                <div class="col-lg-4  col-md-9  col-sm-6 col-xs-8">
                    <p>
                        <span><a href="{{route('product',[$item->attributes->slug] )}}">{{ $item->name }}</a></span><br>
                        Precio:<span> ${{ $item->price }}</span><br>
                        Sub Total: <span>$<span id="subtotal{{$item->id}}">{{ \Cart::get($item->id)->getPriceSum() }}</span><br>
                            @if ($item->attributes->desc > 0)
                            Descuento: <span>- {{$item->attributes->desc}} %</span>
                            @endif
                            <br>
                    </p>
                </div>
                <div >
                    <span id="mjs{{$item->id}}"></span>
                    <div class="input-group number-spinner ">
                        <span class="input-group-btn">
                            <button class="btn btn-default" data-dir="dwn" name="{{$item->id}}"><span
                                    class="ti-arrow-down"></span></button>
                        </span>
                        <input type="text" class="form-control text-center" style="width: 70px;" id="{{$item->id}}"
                            value="{{ $item->quantity }}">
                        <span class="input-group-btn pull-left ">
                            <button class="btn btn-default" data-dir="up" name="{{$item->id}}"><span
                                class="ti-arrow-up"></span></button>
                        </span>
                    </div>
                </div>
                <div class="text-right">
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <a href="{{route('remove', ['id' =>  $item->id] )}}" class="pull-right">
                        <button type="button" class="btn btn-secondary">&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class="fa fa-trash "
                                aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                </div>
            </div>
            <hr>
            @endforeach
            @if(count($cartCollection)>0)
            <ul class="{{-- list-group --}} {{-- list-group-flush --}} text-center">
                <a href="{{route('clearcart')}}" class="main_btn3">Limpiar carro</a>
            </ul>
            <hr>
            @endif
        </div>
        @if(count($cartCollection)>0)
        <div class="text-center col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div>

                <h4 class="text-center"> Total: $</span> <span class="tota">{{ \Cart::getTotal() }}</span> </h4>
                <P>Costo por envio $1.99 en zona metroplitana  S.S. y sus alredores, consultar por el costo fuera del area de S.S. </P>
                <br>
                <p class="text-center">
                    <a href="{{route('checkout')}}" class="main_btn">Terminar compra</a>
                </p>
                <br>
                <p class="text-center">
                    <a href="{{route('/')}}" class="main_btn2">Continuar comprando</a>
                </p>
            </div>
        </div>
        @endif
    </div>

</div>
@endsection