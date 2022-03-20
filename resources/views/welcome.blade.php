@extends('online.master')
@section('title','MTECH TIENDA ARTICULOS INFORMATICOS EL SALVADOR')
@section('content')

<section class="mb-40" >
	
	<div id="carouselExampleIndicators" class="carousel slide  pr-0 d-none d-sm-none d-md-none d-lg-block" data-ride="carousel" >
		<ol class="carousel-indicators">
		  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> 
		</ol>
		<div class="carousel-inner">
		  <div class="carousel-item active">
			<img class="d-block w-100" src="{{asset("imagenes/carrusel/".$varios->cimagen)}}" alt="First slide" alt="First slide">
			<div class="carousel-caption d-none d-md-block text-left">
				<a class="main_btn_w mt-40" href="./{{$varios->url}}"  title="MAS INFORMACION"> <span style="font-size: 20px; ">{{ str_replace('-', ' ', $varios->url)}}</span></a>
			</div>
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="{{asset("imagenes/carrusel/".$varios->cimagen2)}}" alt="First slide" alt="Second slide">
			<div class="carousel-caption  text-left">
				<a class="main_btn_w mt-40" href="./{{$varios->url2}}"  title="MAS INFORMACION"><span style="font-size: 20px; ">{{ str_replace('-', ' ', $varios->url2)}}</span></a>
			</div>
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100"src="{{asset("imagenes/carrusel/".$varios->cimagen3)}}" alt="First slide" alt="Third slide">
			<div class="carousel-caption text-left">
				<a class="main_btn_w mt-40"     href="./{{$varios->url3}}" title="MAS INFORMACION"><span style="font-size: 20px; ">{{ str_replace('-', ' ', $varios->url3)}}</span></a>
			</div>
		  </div> 
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		  <span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		  <span class="carousel-control-next-icon" aria-hidden="true"></span>
		  <span class="sr-only">Next</span>
		</a>
	  </div>
	  {{--MOVIL--}}
	  <div id="carouselExampleIndicators2" class="carousel slide   d-block  d-md-block d-lg-none" data-ride="carousel" >
		<div class="carousel-inner">
		  	<div class="carousel-item active">
				<img class="d-block w-100" src="{{asset("imagenes/carrusel/".$varios->ct)}}" alt="First slide">
				<div class="carousel-caption  text-center">
					<a class="main_btn_w mt-40" href="./{{$varios->url}}"  title="MAS INFORMACION"> <span style="font-size: 20px; ">{{ str_replace('-', ' ', $varios->url)}}</span></a>
				</div>
			</div>
			<div class="carousel-item">
			  	<img class="d-block w-100" src="{{asset("imagenes/carrusel/".$varios->ct2)}}" alt="Second slide">
			  	<div class="carousel-caption  text-center">
					<a class="main_btn_w mt-40" href="./{{$varios->url2}}"  title="MAS INFORMACION"><span style="font-size: 20px; ">{{ str_replace('-', ' ', $varios->url2)}}</span></a>
				</div>	  
			</div>
		  	<div class="carousel-item">
				<img class="d-block w-100" src="{{asset("imagenes/carrusel/".$varios->ct3)}}" alt="Third slide">
				<div class="carousel-caption  text-center">
					<a class="main_btn_w mt-40"     href="./{{$varios->url3}}" title="MAS INFORMACION"><span style="font-size: 20px; ">{{ str_replace('-', ' ', $varios->url3)}}</span></a>
				</div>	
			</div>
		  </div> 

		  <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
		</div>
</section>
<!--================End Home Banner Area =================-->
<!-- Start feature Area  DESK -->


<section>
	<div class="container" style="max-width: 1500px;" >
	{{-- 	<div class="text-center" style=" height: 60px;	display: flex; justify-content: center; align-items: center;"> 
			<h4 style="color:#023E7D; "> RETIRE EN TIENDA O   SOLICITE A DOMICILIO <i class="fa fa fa-truck "></i> </h4>
		</div>  --}}
		<div class="justify-content:center"  style="background:#ffa420; padding-top: 15px; padding-bottom: 7px;">
			<div class="col-lg-12">
				<div class="main_title">
					<h4 style="color:#023E7D; "> RETIRE EN TIENDA O   SOLICITE A DOMICILIO <i class="fa fa fa-truck "></i> </h4>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			@foreach ($destacados as $item)
			@php $precio = precio($item, $varios) @endphp
			<div class="col-6   col-xl-2 col-lg-3 col-md-3 col-sm-6  p-0">
				<div class="single-product m-2"
					style="/* border-radius: 10px; box-shadow: 3px 3px 20px rgba(0, 0, 0, .5); */ padding-top: 2px;">
					<div class="product-img">
						<div class="inner">
							<a href="{{route('product',[$item->slug] )}}">
								@if ($item->imagen1 != null)
								<img class="card-img-top" src="{{ asset("imagenes/articulos/".($item->imagen5 == null ? $item->imagen1 :  $item->imagen5))}}"
								alt="{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}">
								@else
								<img class="card-img-top" src="{{ asset("imagenes/articulos/patucel.jpg")}}" alt="">
								@endif
							</a>
						</div>
						<input type="hidden" id="slug{{$item->idarticulo}}" value="{{$item->slug}}">
						<input type="hidden" id="imgp{{$item->idarticulo}}" value="{{$item->imagen1}}">
						<input type="hidden" id="prec{{$item->idarticulo}}" value="{{number_format($precio[1], 2, '.', '')}}">
						<input type="hidden" id="cant{{$item->idarticulo}}" value="1">
						<input type="hidden" id="desc{{$item->idarticulo}}" value="{{$item->descuento_art}}">

					
						@if (isset(auth('clients')->user()->nombre))            
						<div class="p_icon">
							<button class="main_btn" id="{{$item->idarticulo}}" onclick="enviar(this.id)">
								AGREGAR <i class="fa fa-shopping-cart add-to-cart-btn2"></i>
							</button>
						</div>  
                            @else
                                <p style="color:black;"> {{-- Inicie sesión para agregar al carrito --}} </p>
                            @endif
					</div>
					<div class="p-2" style="height: 120px; background: #f6f6f6;  border-radius: 0  0 10px 10px;">
					
						<div class="block3">
							<h6  id="proc{{$item->idarticulo}}" style="color: #33415C; font-size: 12px;">{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}</h6>	
						</div>	
						<div class="block2 ">
							<h4 style="color: #BF0811;  font-size: 20px;">${{number_format($precio[1], 2, '.', ',')}} <small>	@if($item->descuento_art > 0) <del style="color : #023E7D; font-weight: bold; ">${{number_format($precio[0], 2, '.', ',')}}</del>
								@endif</small> </h4> 
						
						</div>
						<div class="block3" styl@foreach ($top as $item)e="text-align: right;  p-b 0;  position: absolute; bottom:10px;">
							<a class="active"  href="./{{$item->cslug}}">
								<span>{{$item->nombreCategoria}}</span> </a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<br>
	</div>
</section> 
<br>
<section class="blog-area section-gap">
    <div class="container" style="max-width: 1500px;" >
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
			<h2><span>CATEGORIAS PRINCIPALES</span></h2>
			<br>
          </div>
        </div>
      </div>

      <div class="row">
		@foreach ($catwel as $cat)
        <div class="col-lg-3 col-md-6">
          <div class="single-blog">
            <div class="thumb">
				<a class="nav-link" href="./{{$cat->cslug}}"> <img class="img-fluid" src="{{asset("imagenes/categorias/".$cat->movil)}}" alt=""></a>
				<a class="d-block" href="./{{$cat->cslug}}">
					<h4><p class="text-center">{{$cat->nombreCategoria}}</p></h4>
					<h5><p class="text-justify">{{$cat->ch2}}</p></h5>
				  </a>
            </div>
           {{--  <div class="short_details">
				<a class="d-block" href="./{{$cat->cslug}}">
				  <h4><p class="text-center">{{$cat->nombreCategoria}}</p></h4>
				  <h5><p class="text-justify">{{$cat->ch2}}</p></h5>
				</a>
			</div> --}}
          </div>
        </div>
		@endforeach
		{{-- <div class="col-lg-3 col-md-6">
			<div class="single-blog">
			  <div class="thumb">
				  <a class="nav-link"  href="{{route('oferta')}}"> <img class="img-fluid" src="{{asset("imagenes/categorias/oferta.jpg")}}" alt=""></a>
				  <a class="d-block"  href="{{route('oferta')}}">
					  <h4><p class="text-center">OFERTAS </p></h4>
					  <h5><p class="text-justify">PRODUCTOS CON DESCUENTO</p></h5>
					</a>
			  </div>
			
			</div>
		  </div> --}}
      </div>
    </div>
  </section>   
<!-- Start feature Area  MOVIL -->
<div class="container   d-block d-sm-none  d-md-none d-lg-none" style="max-width: 1500px;"> 
	<div  class="carousel slide carousel-multi-item" data-ride="carousel">
	  	<div class="carousel-inner" role="listbox">
			@foreach( $marcas->chunk(2) as $key =>$chunk)
				<div class="carousel-item {{$key == 0 ? 'active' : '' }}">
					<div class="row">						
					@foreach( $chunk as  $item )
						<div  class="col-6 col-lg-2 col-md-2  col-sm-2">
							<a href="{{route('buscar', ['id' =>  '%' ,  'id2' =>  $item->idMarca])}}">
							<img class="card-img-top"  src="{{ asset("imagenes/logos/".$item->logo)}}"  alt="Card image cap"  width="150">
						</a>
						</div>	
					@endforeach
					</div>
				</div>
			@endforeach
		</div>
	</div>     
</div>

<section class="feature-area section_gap_bottom_custom2" style="padding-top: 30px;">
	<div class="container pr-0 d-none d-sm-none d-md-none d-lg-block">
		<div class="row ">
			<div class="col-6 col-lg-4 col-md-6">
				<a href="{{route('marcas')}}"class="title">
				<div class="single-feature">
					<i class="ti-crown" style="font-size: 30px; color: #0791EB;"></i>
					<h3 style="color: #4a4a4a">Marcas reconocidas</h3>
					<p> &nbsp;</p>
				</div>
				</a>
			</div>
	
			<div class="col-6 col-lg-4 col-md-6">
				<a href="{{route('envios')}}"class="title">
				<div class="single-feature">
					<i class="ti ti-truck" style="font-size: 30px; color: #0791EB;" ></i>
					<h3>Envios  DESDE $1.99</h3>
					<p> &nbsp;</p>
				</div>
				</a>
			</div>
			<div class="col-4 col-lg-4 col-md-6 ">
				<div class="single-feature">
					<a  class="title">
						<i class="ti-headphone" style="font-size: 30px; color: #0791EB;"></i>
						<h3>Soporte en linea</h3>
					</a>
					<p> &nbsp;</p>
				</div>
			</div>
		</div>
	</div>
</section>
	
<section>
	<div class="container  d-block  d-md-block d-lg-none">
		<div class="row ">
			<div class="col-12 col-xl-2 col-lg-3 col-md-6 col-sm-6  p-0">
				<a href="{{route('marcas')}}">
				<div class="single-feature-movil"  >
					<h4 style="color: #4a4a4a"><i class="ti-crown" style=" font-size: 30px; color:  #0791EB;"></i>&nbsp;&nbsp;&nbsp; MARCAS RECONOCIDAS</h4>
				</div>
				</a>
			</div>
			<div class="col-12   col-xl-2 col-lg-3 col-md-6 col-sm-6  p-0">
				<a href="{{route('envios')}}"class="title">
				<div class="single-feature-movil">
					<h4 style="color: #4a4a4a"> <i class="ti ti-truck"  style=" font-size: 30px; color:  #0791EB;"></i> &nbsp;&nbsp;&nbsp;ENVIOS DESDE $1.99</h4>
				</div>
				</a>
			</div>
		</div>
	</div>	
</section> 

<div class="container d-none d-sm-block d-lg-block" style="max-width: 1500px;" > 
	<div  class="carousel slide carousel-multi-item" data-ride="carousel">
	  	<div class="carousel-inner" role="listbox" >
			@foreach( $marcas->chunk(6) as $key =>$chunk)
				<div class="carousel-item {{$key == 0 ? 'active' : '' }}">
					<div class="row"  >
					@foreach( $chunk as  $item )
						<div  class="col-6 col-lg-2 col-md-2  col-sm-2">
							<a href="{{route('buscar', ['id' =>  '%' ,  'id2' =>  $item->idMarca])}}">
							<img class="card-img-top"  src="{{ asset("imagenes/logos/".$item->logo)}}"  alt="Card image cap">
						</a>	
						</div>	
					@endforeach
					</div>
				</div>
			@endforeach
		</div>
	</div>     
</div> 
<!--================ End Feature Product Area =================-->
@endsection
{{-- <script src="{{asset('vendors/nice-select/js/jquery.nice-select.min.js')}}"></script> --}}