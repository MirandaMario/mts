@extends('online.master')
@section('title','Canjeables por puntos')
@section('content')
<!-- SECTION -->
<div class="container " style="max-width: 1500px; ">
	<br>
	<div class="row flex-row-reverse">
		<div class="col-lg-12">
			
			{{-- {!! Form::open(array('url'=>'buscar','method'=>'get','role'=>'search')) !!} --}}
			<div class="product_top_bar border">
				PRODUCTOS CANJEABLES POR PUNTOS
				{{-- <div class="left_dorp">
					<select class="show small" name="id">
						<option value="%">TODAS CATEGORIAS</option>
						@foreach ($categorias2 as $c)
						<option value="{{$c->idcategoria}}" {{$c->idcategoria == $idcat ? "selected" : ""}}>
							<b>{{$c->nombreCategoria}}</b></option>
						@endforeach
					</select>&nbsp; &nbsp;
					<select class="show small" name="id2">
						<option value="%">TODAS MARCAS</option>
						@foreach ($marcas as $m)
						<option value="{{$m->idMarca}}" {{$m->idMarca == $idmar ? "selected" : ""}}> {{$m->nombreMarca}}
						</option>
						@endforeach
					</select>

				</div>
				&nbsp; &nbsp;<button class="main_btn genric-btn  medium" type="submit">
					Buscar
				</button> --}}
			</div>
				{{-- {{Form::close()}} --}}
			<br>
			<div class="latest_product_inner">
				<div class="row">
					{{-- 	@php
						dump($productos)
					@endphp --}}
					@foreach ($productos as $item)
					@php $precio = precio($item, $varios) @endphp
					<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6  p-0">
						<div class="single-product  m-2"
							style="border-radius: 10px; box-shadow: 3px 3px 20px rgba(0, 0, 0, .5); padding-top: 2px;">
							
							<div class="product-img">
								<div class="inner">
									<a href="{{route('product',[$item->slug] )}}">
										@if ($item->imagen1 != null)
										<img class="card-img-top" src="{{ asset("imagenes/articulos/".$item->imagen1)}}"
											alt="{{$item->nombre .'  '.   $item->nombreModelo}}">
										@else
										<img class="card-img-top" src="{{ asset("imagenes/articulos/patucel.jpg")}}"
											alt="">
										@endif
									</a>

								</div>
								<input type="hidden" id="slug{{$item->idarticulo}}" value="{{$item->slug}}">
								<input type="hidden" id="imgp{{$item->idarticulo}}" value="{{$item->imagen1}}">
								<input type="hidden" id="prec{{$item->idarticulo}}"
									value="{{number_format($precio[1], 2, '.', ',')}}">
								<input type="hidden" id="cant{{$item->idarticulo}}" value="1">
								<input type="hidden" id="desc{{$item->idarticulo}}" value="{{$item->descuento_art}}">

						
							</div>

							<div class="p-2"
								style="height: 120px; background: #f6f6f6;  border-radius: 0  0 10px 10px;">
								<div>
									<h6 id="proc{{$item->idarticulo}}" style="color: #33415C; ">
										{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}
									</h6>
								</div>

								<div class="block2">
								<h4>Canjealo por {{$item->premio}} puntos </h4> 

								</div>
							</div>
						
						</div>
					</div>
					@endforeach
				</div>
			</div><br><br>
			<div class="store-pagination">
				<div class="custom-pagination-brand-blue">
					{{ $productos->appends(['id'=> $idcat , 'id2'=> $idmar])->links() }}
				</div>
			</div>
			<div>
				@if ($productos->count() == 0 )
				<br>
				<P> NO SE ENCUENTRAN PRODUCTOS RELACIONADOS CON SUS CRITERIOS DE BUSQUEDA... PRUEBE CON OTRA COMBINACION
					:) </P>

				@endif
				MOSTRANDO {{ $productos->count()}} DE {{ $productos->total()}}
			</div>
		</div>
		{{-- <div class="col-lg-3" >
			<div class="left_sidebar_area" >
				<aside class="left_widgets p_filter_widgets" style="background: rgba(0, 0, 0, .0.5);">
					<div class="l_w_title">
						<h3>CATEGORIAS</h3>
					</div>

					<div class="widgets_inner">
					
						<ul class="list">
							@foreach ($categorias2 as $c)
							<li {{($c->idcategoria == $idcat) ? "class=active" :" "}}>
		<a href="{{route('catalogo', ['id' =>  $c->idcategoria])}}">
			{{$c->nombreCategoria}}
		</a>
		</li>
		@endforeach
		</ul>

	</div>
	</aside>

	<aside class="left_widgets p_filter_widgets">
		<div class="l_w_title">
			<h3>MARCAS</h3>
		</div>
		@php
		//dump($idmar);
		@endphp
		<div class="widgets_inner">
			<ul class="list">
				@foreach ($marcas as $c)
				<li {{($c->idMarca == $idmar) ? "class=active" :" "}}>
					<a href="{{route('buscar', ['id2' =>  $c->idMarca, 'id' => '%' ])}}">
						{{$c->nombreMarca}}
					</a>
					@endforeach
				</li>
			</ul>
		</div>
	</aside>
</div>
</div> --}}

</div>
<br> 
Términos y condiciones de los puntos y productos canjeables 

<br>
a) 	Los puntos no son transferibles <br>

b)	Los puntos no tiene fecha de caducidad <br>

c) 	Los productos canjeables están sujetos a cambios en cantidad de puntos sin previo aviso<br>

d) 	Los productos canjeables están sujetos a disponibilidad en inventario<br>

e) 	Los puntos unicamente pueden ser canjeables por productos canjeables <br>

f) 	La cantidad de puntos asignada a un producto puede ser cambiada sin previo aviso** <br>

g) 	La cantidad de puntos asignados al ser facturado ya no varia**<br>

h) 	Tienes que estar registrado,  nombre y correo, para tener el histórico de compras y puntos.<br><br>
</div>

</section>

@endsection