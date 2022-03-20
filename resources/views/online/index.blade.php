@extends('online.master')
@section('title', isset($datos_categoria) ? $datos_categoria->nombreCategoria . " | MTECH EL SALVADOR" : "Resultado busqueda | MTECH EL SALVADOR")
@section('cdescripcion', isset($datos_categoria) ? $datos_categoria->cdescripcion : null)
@section('ckeyword',  isset($datos_categoria) ? $datos_categoria->ckeyword : null )
@section('content')
<!-- SECTION -->
@isset($datos_categoria)
<div class="jumbotron jumbotron-fluid">
	<div class="container"><BR><BR>
	  <h1 class="display-4">{{$datos_categoria->ch1}}</h1>
	   <h3 class="display-5">{{$datos_categoria->ch2}}</h3>
	   <br>
	   <div >
		{!!$datos_categoria->ctexto!!}
	  </div>
	</div>
  </div>
@endisset
{{-- @isset($str)
<div >
	<div class="container"><BR><BR>
	  <h1 class="display-4">Resultados de la busqueda <b>{{$str}}</b></h1>
	</div>
  </div>
@endisset --}}


<div class="container " style="max-width: 1500px; ">
	<div class="justify-content:center"  style="background:#ffa420; padding-top: 15px; padding-bottom: 7px;">
		<div class="col-lg-12">
			<div class="main_title">
				<h4 style="color:#023E7D; "> RETIRE EN TIENDA O   SOLICITE A DOMICILIO <i class="fa fa fa-truck "></i> </h4>
			</div>
		</div>
	</div>
	
	
	<div class="row flex-row-reverse">

		<div class="col-lg-12">
			{!! Form::open(array('url'=>'buscar','method'=>'get','role'=>'search')) !!}
			<div class="product_top_bar border">
				<div class="left_dorp">
					<select class="show form-control" name="id">
						<option value="%">TODAS CATEGORIAS</option>
						@foreach ($categorias as $c)
						<option value="{{$c->idcategoria}}"   {{-- {{$c->idcategoria == $idcat ? "selected" : ""}} --}}>
							<b>{{$c->nombreCategoria}}</b></option>
						@endforeach
					</select>&nbsp; &nbsp;
					<select class="show  form-control" name="id2">
						<option value="%">TODAS MARCAS</option>
						@foreach ($marcas as $m)
						<option value="{{$m->idMarca}}" {{-- {{$m->idMarca == $idmar ? "selected" : ""}} --}}> {{strtoupper($m->nombreMarca)}}
						</option>
						@endforeach
					</select>
				</div>
				&nbsp; &nbsp;<button class="main_btn genric-btn  medium" type="submit">
					Buscar
				</button>
				{{Form::close()}}

			
			</div>
			<br>
			<div class="latest_product_inner">
				<div class="row">
					@foreach ($productos as $item)
					@php $precio = precio($item, $varios) @endphp
					<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 p-0">
						<div class="single-product  m-2"
						style="/* border-radius: 10px; box-shadow: 3px 3px 20px rgba(0, 0, 0, .5); */ padding-top: 2px;">
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
								<div class="text-left"><span style="color: #6e7279; ">{{$item->stock.'-'.$item->codigo}}</span></div>	
								</div>
								<input type="hidden" id="slug{{$item->idarticulo}}" value="{{$item->slug}}">
								<input type="hidden" id="imgp{{$item->idarticulo}}" value="{{$item->imagen1}}">
								<input type="hidden" id="prec{{$item->idarticulo}}"
									value="{{number_format($precio[1], 2, '.', ',')}}">
								<input type="hidden" id="cant{{$item->idarticulo}}" value="1">
								<input type="hidden" id="desc{{$item->idarticulo}}" value="{{$item->descuento_art}}">
								{{-- @if (isset(auth('clients')->user()->nombre))  --}}           
									{{-- <div class="p_icon">
										@if ($item->stock <= 0 )
											<button class="main_btn3" id="{{$item->idarticulo}}">AGOTADO :(</i>
											</button>
										@else
											<button class="main_btn" id="{{$item->idarticulo}}"
												onclick="enviar(this.id)">AGREGAR <i class=" fa fa-shopping-cart"></i>
											</button>
										@endif
									</div>  --}}
								{{-- @else
									<p style="color:black;"> Inicie sesión para agregar al carrito </p>
								@endif --}}
							</div>
							<div class="p-2"
								style="height: 100px; background: #f6f6f6;  border-radius: 0  0 10px 10px;">
								<div>
									<h6 id="proc{{$item->idarticulo}}" style="color: #33415C; ">
										{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}
									</h6>
								</div>
								<div class="block2">
									<h4>${{number_format($precio[1], 2, '.', ',')}} <small>@if($item->descuento_art > 0)
											<del
												style="color : #023E7D;  ">${{number_format($precio[0], 2, '.', ',')}}</del>
											@endif</small></h4>
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
	</div>
</div>
</section>
@endsection