<section>
	<div class="container" style="max-width: 1500px; "  >
		<div class="justify-content:center" style=" background: #FFFF00; padding-top: 15px; padding-bottom: 7px;">
			<div class="col-lg-12">
				<div class="main_title">
					<h2 style="color: #4a4a4a">PRODUCTOS CON DESCUENTO O LIQUIDACION <small><a href="{{route('oferta')}}" style="color: #002855"> Ver todos</a></small></h2> 
				</div>
			</div>
		</div>
		<br>
	
		<div class="row" style=" background-color: WHITE;">
			@foreach ($productos2 as $item)
			@php $precio = precio($item, $varios) @endphp
			<div class="col-6   col-xl-2 col-lg-3 col-md-3 col-sm-6  p-0" >
				<div class="single-product m-2"
					style="border-radius: 5px; box-shadow: 0px 0px 0px rgba(0, 0, 0, .5); padding-top: 2px;">
					<div class="text-center"  ><span  style="background-color: yellow;Height 50%;padding-top: 5px;padding-bottom: 5px;padding-left: 5px;padding-right: 5px;">  DESCUENTO {{$item->descuento_art}}%  </span> &nbsp;&nbsp;</div>
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
                         
                        @endif
					</div>
					<div class="p-2" style="height: 120px; /* background: #f6f6f6;  border-radius: 0  0 10px 10px; */">
					
						<div class="block3">
							<h6  id="proc{{$item->idarticulo}}" style="color: #33415C; font-size: 12px;">{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}</h6>	
						</div>	
						<div class="block2 ">
							<h4 style="color: #BF0811;  font-size: 20px;">${{number_format($precio[1], 2, '.', ',')}} <small> 	@if($item->descuento_art > 0)  <del style="color : #023E7D; font-weight: bold;">${{number_format($precio[0], 2, '.', ',')}}  </del> 
								@endif</small> </h4> 
						
						</div>
						
						<div class="block3" style="text-align: right;  p-b 0;  position: absolute; bottom:10px;">
							<a class="active" href="./{{$item->cslug}}">
								<span>{{$item->nombreCategoria}}</span> </a>

						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<br><br>
		
		<div  style="text-align: center;" >@foreach ($categorias as $cat)&nbsp;&nbsp;<a href="./{{$cat->cslug}}" style="color: #002855"> {{strtoupper($cat->nombreCategoria)}}</a>@endforeach
		</div>
	</div>
</section>


<section>
	<div class="container" style="max-width: 1500px;" >
		<div class="justify-content:center"  style=" background:  #FFA500; padding-top: 15px; padding-bottom: 7px;">
			<div class="col-lg-12">
				<div class="main_title">
				<h2 style="color: #4a4a4a">NUEVOS PRODUCTOS</h2>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			@foreach ($productos as $item)
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
                                <p style="color:black;"> </p>
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
						<div class="block3" style="text-align: right;  p-b 0;  position: absolute; bottom:10px;">
							<a class="active"  href="./{{$item->cslug}}">
								<span>{{$item->nombreCategoria}}</span> </a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<br>
</section> 

<section>
	<div class="container" style="max-width: 1500px;">
		<div class="justify-content:center" style=" background:  #FFA500; padding-top: 15px; padding-bottom: 7px;">
			<div class="col-lg-12">
				<div class="main_title">
					<h2 style="color: #4a4a4a">PRODUCTOS CANJEABLES POR PUNTOS  <small><a href="{{route('premio')}}" style="color: #002855"> Ver todos</a></small></h2> 
				</div>
			</div>
		</div>
		@php
		
		@endphp
		<div class="row" style="background-color: WHITE;">
			@foreach ($productos3 as $item)
			@php $precio = precio($item, $varios) @endphp
			<div class="col-6  col-xl-2 col-lg-3 col-md-3 col-sm-6  p-0" >
				<div class="single-product m-2"
				style="border-radius: 5px; box-shadow: 0px 0px 0px rgba(0, 0, 0, .5); padding-top: 2px;">
					
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

						
					</div>
					<div class="p-2" style="height: 120px; /* background: #f6f6f6;  border-radius: 0  0 10px 10px; */">
					
						<div class="block3">
							<h6  id="proc{{$item->idarticulo}}" style="color: #33415C; font-size: 12px;">{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}</h6>	
						</div>	
						<div class="block2 " style="text-align: right;  p-b 0;  position: absolute; bottom:10px;">
							<h5>Canjealo por {{$item->premio}} puntos </h5> 
						
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<br><br>
		
	</div>
	
	</div>
</section>

<section class="feature_product_area section_gap_bottom_custom">
	<div class="container" style="max-width: 1500px;">
		<div  class="justify-content:center" style=" background:  #FFA500; padding-top: 15px; padding-bottom: 7px;">
			<div class="col-lg-12">
				<div  class="main_title">
					<h2 style="color: #4a4a4a">PRODUCTOS MAS VENDIDOS</h2>
				</div>
			</div>
		</div>
		<div class="row" >
			@foreach ($top as $item)
			@php $precio = precio($item, $varios) @endphp
			<div class="col-6 col-xl-2 col-lg-3 col-md-3 col-sm-6  p-0"  >
				<div class="single-product m-2"
					style="/* border-radius: 10px; box-shadow: 3px 3px 20px rgba(0, 0, 0, .5); */ padding-top: 2px;">
					<div class="product-img">
						<div class="inner">
							<a href="{{route('product',[$item->slug] )}}">
								@if ($item->imagen1 != null)
								<img class="card-img-top" src="{{ asset("imagenes/articulos/".($item->imagen5 == null ? $item->imagen1 :  $item->imagen5) )}}"
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
                                <p style="color:black;">  </p>
                            @endif
					</div>
					<div class="p-2" style="height: 120px; background: #f6f6f6;  border-radius: 0  0 10px 10px;">
					
						<div class="block3">
							<h6  id="proc{{$item->idarticulo}}" style="color: #33415C;  font-size: 12px; ">{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}</h6>	
						</div>	
						<div class="block2 ">
							<h4 style="color: #BF0811;  font-size: 20px;">${{number_format($precio[1], 2, '.', ',')}} <small>	@if($item->descuento_art > 0) <del style="color : #023E7D; font-weight: bold; ">${{number_format($precio[0], 2, '.', ',')}}</del>
								@endif</small> </h4> 
						</div>
						<div class="block3" style="text-align: right;  p-b 0;  position: absolute; bottom:10px;">
							<a class="active" href="./{{$item->cslug}}"> 
								<span>{{$item->nombreCategoria}}</span> </a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>