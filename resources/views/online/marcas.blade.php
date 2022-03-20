@extends('online.master')
@section('title','Marcas')
@section('content')
<!-- SECTION -->
<div class="container " style="max-width: 1500px; ">
	<br>
	<div class="row flex-row-reverse">
		<div class="col-lg-12">
			<div class="product_top_bar border">
				Marcas
			</div>
			<br>
			<div class="latest_product_inner">
				<div class="row">
					@foreach ($marcas as $item)
					@if ($item->logo != null)
					<div class="col-6 col-xs-2 col-xl-2 col-lg-2 col-md-2 col-sm-3  p-0">
						<div class="single-product  m-2">
							<div class="product-img">
								<div class="inner">
									<a href="{{route('catalogo', ['idmarca' =>  $item->idMarca])}}">
										
										<img class="card-img-top" src="{{ asset("imagenes/logos/".$item->logo)}}"
											alt="{{$item->nombreMarca}}" style= "width: 200px; height: 100px;">
										
									</a>
									{{-- <label for="">{{$item->nombreMarca}}</label> --}}
								</div>
							</div>
						</div>
					</div>
					@endif
				@endforeach
			</div>
		</div><br><br>
	</div>
</div>

</section>

@endsection