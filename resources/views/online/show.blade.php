@extends('online.master')
@section('title', strtoupper($producto->nombre) ." ".strtoupper($producto->nombreMarca) ." ".strtoupper($producto->nombreModelo). " || MTECH EL SALVADOR" )
@section('cdescripcion', isset($producto->des_sf) ? $producto->des_sf : null)
@section('ogUrl', 'https://mtech-sv.com/'.$producto->slug)
@section('ogTitle', $producto->nombre . " " .$producto->nombreMarca . " " .$producto->nombreModelo)
@section('ogDesc', isset($producto->des_sf) ? $producto->des_sf : null)
@section('ogImage', 'https://mtech-sv.com/imagenes/articulos/'.$producto->imagen1)

@section('content')
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }


    .embed-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }

    .embed-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

</style>
<!-- BREADCRUMB -->
<div class="container">
    <div class="justify-content:center"  style="background:#ffa420; padding-top: 15px; padding-bottom: 7px; margin-top:20px">
        <div class="col-lg-12">
            <div class="main_title">
                <h4 style="color:#023E7D; "> RETIRE EN TIENDA O   SOLICITE A DOMICILIO <i class="fa fa fa-truck "></i> </h4>
            </div>
        </div>
    </div>
</div>
<div id="breadcrumb" class="section">
  
    <!-- container -->
    <div class="container">
        <!-- row --> <br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               {{--  <li class="breadcrumb-item"><a href="./">INICIO</a></li> --}}
                <li class="breadcrumb-item active"><a class="active" href="./{{$producto->cslug}}">
                     {{$producto->nombreCategoria}}</a></li>
                     @foreach ($catwel as $cat)
                        @if ($producto->nombreCategoria != $cat->nombreCategoria)
                        <li class="breadcrumb-item"><a  href="./{{$cat->cslug}}">{{$cat->nombreCategoria}}</a></li>
                        @endif  
                     @endforeach     
            </ol>
        </nav>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <!--================Single Product Area =================-->

    <div class="container">
        <div class="row ">
            <div class="col-lg-6">
                <div class="s_product_img">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        @if ($producto->imagen2 != null )
                        <ol class="carousel-indicators">
                            @if ($producto->imagen1 != null)
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                                <img src="{{ asset("imagenes/articulos/".$producto->imagen1)}}" width="60" height="60"
                                    alt="{{$producto->nombre}} {{$producto->nombreModelo}}" alt="First slide" />
                            </li>
                            @endif

                            @if ($producto->imagen2 != null)
                            <li data-target="#carouselExampleIndicators" data-slide-to="1">
                                <img src="{{ asset("imagenes/articulos/".$producto->imagen2)}}" width="60" height="60"
                                    alt="{{$producto->nombre}} {{$producto->nombreModelo}}" alt="First slide" />
                            </li>

                            @endif
                            @if ($producto->imagen3 != null)
                            <li data-target="#carouselExampleIndicators" data-slide-to="2">
                                <img src="{{ asset("imagenes/articulos/".$producto->imagen3)}}" width="60" height="60"
                                    alt="{{$producto->nombre}} {{$producto->nombreModelo}}" alt="First slide" />
                            </li>
                            @endif
                            @if ($producto->imagen4 != null)
                            <li data-target="#carouselExampleIndicators" data-slide-to="3">
                                <img src="{{ asset("imagenes/articulos/".$producto->imagen4)}}" width="60" height="60"
                                    alt="{{$producto->nombre}} {{$producto->nombreModelo}}" alt="First slide" />
                            </li>
                            @endif
                        </ol>
                        @endif

                        <div class="carousel-inner mt-4">
                            @if ($producto->imagen1 != null)
                            <div class="carousel-item active">
                                <img id="myImg" class="d-block w-100"
                                    src="{{ asset("imagenes/articulos/".$producto->imagen1)}}" alt="First slide" />
                            </div>
                            @endif
                            @if ($producto->imagen2 != null)
                            <div class="carousel-item">
                                <img id="myImg2" class="d-block w-100"
                                    src="{{ asset("imagenes/articulos/".$producto->imagen2)}}" alt="First slide" />
                            </div>
                            @endif
                            @if ($producto->imagen3 != null)
                            <div class="carousel-item">
                                <img id="myImg3" class="d-block w-100"
                                    src="{{ asset("imagenes/articulos/".$producto->imagen3)}}" alt="First slide" />
                            </div>
                            @endif
                            @if ($producto->imagen4 != null)
                            <div class="carousel-item">
                                <img id="myImg4" class="d-block w-100"
                                    src="{{ asset("imagenes/articulos/".$producto->imagen4)}}" alt="First slide" />
                            </div>
                            @endif
                        </div>




                    </div>
                </div>
            </div>
            @php
            // dump($producto);
            @endphp
            <div class="col-lg-5 offset-lg-1">
                <br>
                <div class="row">
                    <div class="s_product_text">
                        @php $precio = precio($producto,$varios) @endphp
                        <h1 class="product-name" style="color: #3e444e; font-size: 25px">
                            {{$producto->nombre}} {{$producto->nombreModelo}}  <span style="color: #6e7279; font-size: 12px">{{$producto->stock.'-'.$producto->codigo}}</span></h1>

                        <div class="text-left"></div>	

                        <h3 id="proc{{$producto->idarticulo}}" style="display: none; ">
                            {{$producto->nombre}} {{$producto->nombreModelo}} {{$producto->nombreMarca}}</h3>
                            <h2>${{number_format($precio[1], 2, '.', ',')}}
                                {!!$producto->descuento_art > 0 ? "<small
                                    class='sale'>-".$producto->descuento_art."%</small>" : ""!!}
                                {!!$producto->descuento_art > 0 ? "<del
                                    class='product-old-price'>".number_format($precio[0], 2)."</del>" : ""!!}
                                    @if ($producto->puntos == 0 )
    
                                    @else
                                   {{--  <small>+ PUNTOS {{$producto->puntos}}  </small> --}}
                                    @endif
                               
                            </h2>
                        {{-- <h4>${{number_format(($precio[1] *1.05), 2, '.', ',')}}
                          
                            <small>Pago con tarjeta</small>
                        </h4> --}}
                        <ul class="list">
                            <li>
                                <a class="active" href="./{{$producto->cslug}}">
                                    <span>Categoria</span> : {{$producto->nombreCategoria}}</a>
                            </li>
                            <li>
                                <a class="active"
                                    href="{{route('buscar', ['id2' =>  $producto->idMarca, 'id' => '%' ])}}">
                                    <span>Marca</span> : {{$producto->nombreMarca}}</a>
                            </li>
                            {{--  <li>
                                <a href="#"> <span>Disponibilidad</span> : In Stock</a>
                            </li> --}}
                            <li>
                                
                            </li>
                        </ul>
                       
                        <hr>
                        <div class="row justify-content-center">
                      
                            <a  href="https://api.whatsapp.com/send?phone=50377793876&text=Necesito%20este%20producto%20https://mtech-sv.com/{{$producto->slug}}"
                                target="_onblank" class="btn btn-success btn-lg">
                                <i class="fa fa-whatsapp fa-lg" aria-hidden="true" style="color:rgb(255, 255, 255); " ></i> 
                                &nbsp; <span style="color:#ffffff;"> SOLICITALO AQUI</span></a>
                        
                        </div>


                        {!!$producto->descripcion!!}
                       
                        @include('online.tasacero')

                       
                        @if ($producto->stock == 0 && $producto->cdc == 1)
                        
                        <h6 style="color: green">COSULTAR DISPONIBILIDAD DE ENTREGA INMEDIATA</h6>
                        
                        @elseif($producto->stock > 0 )
                        <h6 style="color: green">EN STOCK</h6>
                        @else
                        <h6 style="color: red">TEMPORALMENTE AGOTADO</h6>
                        @endif

                    </div>
                    <div class="card_area col-xs-5 col-sm-5 col-md-4 col-lg-6">
                        <div class="input-group number-spinner1">
                            <span class="input-group-btn">
                                <button class="btn btn-default" data-dir="dwn1" aria-label="mas" name="up"><span
                                        class="ti-arrow-down"></span></button>
                            </span>
                            <label for="cant{{$producto->idarticulo}}">
                                <input type="number" class="form-control text-center" id="cant{{$producto->idarticulo}}"
                                    style="width: 70px;" value="1">{{-- Cantidad --}}
                            </label>
                            <span class="input-group-btn pull-left ">
                                <button class="btn btn-default" data-dir="up1" aria-label="menos" name="down"><span
                                        class="ti-arrow-up"></span></button>
                            </span>
                        </div>
                    </div>
                    <div class="card_area col-xs-1 col-sm-1 col-md-1 ">
                        &nbsp;&nbsp;&nbsp;


                        <input type="hidden" id="slug{{$producto->idarticulo}}" value="{{$producto->slug}}">
                        <input type="hidden" id="prec{{$producto->idarticulo}}"
                            value="{{number_format($precio[1], 2, '.', ',')}}">
                        <input type="hidden" id="imgp{{$producto->idarticulo}}" value="{{$producto->imagen1}}">
                        <input type="hidden" id="desc{{$producto->idarticulo}}" value="{{$producto->descuento_art}}">
                    </div>
                    <div class="card_area col-xs-6 col-sm-6 col-md-7 col-lg-5">
                       {{--  @if (isset(auth('clients')->user()->nombre)) --}}
                        <div class="p_icon">
                            <button class="main_btn" id="{{$producto->idarticulo}}" onclick="enviar(this.id)">
                                AGREGAR <i class="fa fa-shopping-cart add-to-cart-btn2"></i>
                            </button>
                        </div>
                        {{-- @else
                        <p style="color:black;"> Inicie sesión para agregar al carrito </p>
                        @endif --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--================End Single Product Area =================-->
<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container ">
        <div class="row nav nav-tabs text-center">
            <h4>DETALLES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @if ($producto->hoja_tecnica != null)
                <a href="{{ asset("fichas/".$producto->hoja_tecnica)}}" target="_blank" style="color: #023E7D; ">
                    <span class="ti-angle-double-right"></span> HOJA TECNICA <span
                        class="ti-angle-double-left"></span></a>
                @endif
            </h4>
        </div>
        <br>
        <div class="row pa">
            @if ($producto->urivideo != null )
            <div class="col-lg-6 ">
                {!!$producto->detalles!!}
            </div>
            <div class="col-lg-6 embed-container">
                {!!$producto->urivideo!!}
            </div>
            @else
            <div class="col-lg-12 ">
                {!!$producto->detalles!!}
            </div>
            @endif

        </div>
    </div>
</section>

<!--================End Product Description Area =================-->
<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">

        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">PRODUCTOS RELACIONADOS</h3><br><br>
                </div>
            </div>
            <!-- product -->

            @foreach ($productos as $item)
            @php $precio = precio($item, $varios) @endphp
            <div class="col-6  col-lg-2 col-md-4 col-sm-6 col-xs-6 p-1  align-self-end">
                <div class="single-product m-2">
                    <div class="product-img" style="align-content: center">
                        <a href="{{route('product',[$item->slug] )}}">
                            @if ($item->imagen1 != null)

                            <img class="card-img" src="{{ asset("imagenes/articulos/".$item->imagen1)}}"
                                alt="{{$item->nombre}}">
                            @else
                            <img class="card-img" src="{{ asset("imagenes/articulos/patucel.jpg")}}" alt="">
                            @endif
                        </a>
                        {{-- <input type="hidden" id="imgp{{$item->idarticulo}}" value="{{$item->imagen1}}">
                        <input type="hidden" id="prec{{$item->idarticulo}}"
                            value="{{number_format($precio[1], 2, '.', ',')}}">
                        <input type="hidden" id="cant{{$item->idarticulo}}" value="1">
                        <input type="hidden" id="desc{{$item->idarticulo}}" value="{{$item->descuento_art}}"> --}}
                    </div>
                    <div style="font-size:12px;">
                        <a href="{{route('product',[$item->slug] )}}" style="color: #002855;  ">{{$item->nombre}}
                            {{$item->nombreModelo}}{{$item->nombreMarca}}</a>
                        <div>
                            <span class="mr-4"> <b>${{number_format($precio[1], 2, '.', ',')}}</b></span>
                            @if($item->descuento_art > 0) <del>${{number_format($precio[0], 2, '.', ',')}}</del>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- /product -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->
<script src="js/jquery-3.2.1.min.js"></script>
<script>
    $(document).on('click', '.number-spinner1 button', function () {    
	var btn = $(this),
		oldValue = btn.closest('.number-spinner1').find('input').val().trim(),
		newVal = 0;
	
	if (btn.attr('data-dir') == 'up1') {
		newVal = parseInt(oldValue) + 1;
	} else {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		} else {
			newVal = 1;
		}
	}
	btn.closest('.number-spinner1').find('input').val(newVal);
});
</script>
@endsection