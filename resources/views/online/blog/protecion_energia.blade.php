@extends('online.master')
@section('cdescripcion', 'UPS Prteccion de computadores, bateria para computadora, ups para router, forza, apc, cdp ,  regulador de voltaje, supresor de picos, regletas, usb ' )
@section('ckeyword',  'Comprar ups , porteccion de energia, bateria para consola video juego , forza, apc, cdp , regulador de voltaje, supresor de picos,  regletas, toma comrriente, usb')
@section('ogTitle', 'Como proteger tus electrodomésticos ? ')
@section('ogDesc', 'Sabes lo que necesitas,  Supresor, Regulador o Respaldo de energia ? En este pequeño artículo te damos una guía')
@section('ogUrl', 'https://mtech-sv.com/'.$slug)
@section('ogImage', 'https://mtech-sv.com/imagenes/art/regleta.jpg')
@section('title', $idcat->nombreCategoria)
@section('content')
 


<!-- SECTION -->
<div class="container " style="max-width: 1500px; ">
	<br><br>
	<div class="row flex-row-reverse">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">
					<h1>Como proteger tus electrodomésticos ?  </h1>
					<h2>Sabes lo que necesitas ?</h2>
					<br>
					<h4>En este pequeño artículo te damos una guía </h4></div>
				<div class="col-lg-1"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10" style="font-size: 16px;">
					<p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
						Proteger nuestros electrodomésticos,  aparatos <b>electrónicos</b>
						ante las  la <b>variaciones</b> e <b>irregularidades del suministro
						de energía eléctrica,</b>  es algo que no se puede tomar a la
						lígera, porque una variación o fluctuación puede llegar a dañar
						un aparato, los daños van desde “quemarse” totalmente, 
						desconfigurarse   “pantallas de tv, consolas de video juegos”,
						perdida  información “equipo informático”,  en ocasiones estos
						se pueden reparar, a veces el costo de reparación es demasiado
						elevado  y se tiene que reemplazar por completo el aparato.</p>
						<p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
						Hay diferentes tipos de protectores eléctricos, entre ellos 
						Supresor de Sobre tensión,  Regulador de voltaje,  Respaldo de
						batería, por lo tanto no  a todos los equipos se les puede dar el
						mismo tratamiento, <b>no</b> todos los aparatos trabajan bajo los
						mismos <b>requerimientos de consumo de energía</b> y <b>delicadeza</b>
						en su circuitería eléctrica.</p>
				</div>
				<div class="col-lg-1"></div>
			</div>
			<div class="row" style="font-size: 16px;">
				<div class="col-lg-1"></div>
				<div class="col-lg-7"><p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
					<font size="3" style="font-size: 13pt"> <h3> Cual necesito? </h3></font></p>
					<p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
					<b> Los supresores de sobre tensión</b>  como regletas y toma corriente son
					orientados a electrodomésticos simples como un <b>horno tostador</b>,
					licuadora, <b>lavadora</b>, horno microondas, <b>refrigeradoras</b>,
					si el voltaje en la zona es estable y no hay muchas variaciones
					también funciona en <b>pantallas, equipos de audio</b> etc, cabe
					mencionar que en el mercado hay  muchas regletas, pero no todas
					cumplen con <b>normas de calidad</b> o mas bien dicho son marcas poco
					conocidas o “pajarito” usar este tipo de regletas puede ocasionar
					daños,  puesto que estas están propensas a falsear en sus
					receptáculos por estar construidas con materiales de mala calidad, 
					eso genera calor  y luego esto pude derivar en fallas.
					</p><h3>Comprar regleta</h3></div>
				<div class="col-lg-3" style="font-size: 12px; text-align : center;   ">
					<img class="card-img-top"  alt="regleta dañada por sobrecarga en receptaculo" src="{{ asset("imagenes/art/regleta.jpg")}}">
					<label for="">**Regleta dañada por recalentamiento </label>
				</div>
				<div class="col-lg-1"></div>

			</div>
			<br><br>
			
			<div class="latest_product_inner">
				
				<div class="row">
					
					<div class="col-lg-1"></div>
					
					@foreach ($productos as $item)
					@php $precio = precio($item, $varios) @endphp
					<div class="col-6  col-xl-2 col-lg-4 col-md-4 col-sm-6  p-0">
						<div class="single-product  m-2">
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

						
								@if (isset(auth('clients')->user()->nombre))            
									<div class="p_icon">
										@if ($item->stock <= 0 )
											<button class="main_btn3" id="{{$item->idarticulo}}">AGOTADO :(</i>
											</button>
										@else
											<button class="main_btn" id="{{$item->idarticulo}}"
												onclick="enviar(this.id)">AGREGAR <i class=" fa fa-shopping-cart"></i>
											</button>
										@endif
									</div> 
	
								@endif
							
							</div>

							<div class="p-2"
								style="height: 80px; background: #f6f6f6;  border-radius: 0  0 10px 10px;">
								<div>
									<h6 id="proc{{$item->idarticulo}}" style="color: #33415C; ">
										{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}
									</h6>
								</div>
								<div class="block2 ">
									<h4 style="color: #BF0811;  font-size: 20px;">${{number_format($precio[1], 2, '.', ',')}} <small>	@if($item->descuento_art > 0) <del style="color : #023E7D; font-weight: bold; ">${{number_format($precio[0], 2, '.', ',')}}</del>
										@endif</small> </h4> 
								
								</div>
							</div>
							
						</div>
					</div>
					@endforeach
					
					<div class="col-lg-1"></div>
					
				</div>
				<br><hr><br>
				<div class="row">
					<div class="col-lg-1"></div>
					
					<div class="col-lg-7" style="font-size: 16px;"><p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
						<b>Reguladores de voltaje</b> <br><br> Los reguladores de voltaje también
						traen incluido lo que es la supresión de tensión, pero como su
						nombre lo dice la diferencia marcada es que estabiliza “regula”
						el voltaje de la red eléctrica.</p>
						
						<p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">hay zonas en donde el voltaje es de
						mala calidad, el voltaje “normal” en una red eléctrica típica
						residencial oscila entre 110 y  120Volt’s, pero en lugares ya sea
						por mala planificación, exceso de consumo el voltaje cae, este
						puede rondar entre  90 a 100volts,  en determinados momento este se
						altera y sube hasta 135 o más,  es acá en donde se producen daños
						en los aparatos electrónicos.</p>
						<p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
						Los reguladores de voltaje son orientados a aparatos como pantallas
						smart,  equipos de sonido, equipos de laboratorio, equipos
						relativamente delicados que tiene un trabajo continuo.</p>
						<p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm"><b>	Como saber la
						capacidad del regulador que necesito? </b>La gran mayoria de reguladores
						en el mercado vienen desde 500Watt’s en adelante, cabe
						mencionar que el valor en watts con el cual se promociona el producto
						es el máximo soportado, es decir si se compra un regulador de
						500watts y se le aplica una carga constante de  400 a 500 watts este
						se vera limitado rápidamente su vida útil. <br><br>Lo ideal es adquirir un
						regulador el cual quede con un margen al menos de 60% ,  por ejemplo
						si tenemos una TV que consume 180Watt’s el regulador ideal es uno
						de 500Watts , suponiendo que tenemos una tv que consume 230watts y un
						PS4 que consume 170 Watts, entre ambos se genera una carga de
						400watts en este caso el regulador ideal seria uno de 1000watts</p>
						<h3>Comprar regulador de voltaje</h3></div>
						<div class="col-lg-3" style="font-size: 12px; text-align : center;   "><br>
							<img class="card-img-top"  alt="viñeta de consumo" src="{{ asset("imagenes/art/consumo.jpg")}}">
							<label for="">**Viñeta con el consumo de energia, consumo denotado en  con la letra W, en este caso el consumo maximo de 155Watts </label>
						</div>
					<div class="col-lg-1"></div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-lg-1"></div>
					@foreach ($productos2 as $item)
					@php $precio = precio($item, $varios) @endphp
					<div class="col-6  col-xl-2 col-lg-4 col-md-4 col-sm-6  p-0">
						<div class="single-product  m-2">
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

						
								@if (isset(auth('clients')->user()->nombre))            
									<div class="p_icon">
										@if ($item->stock <= 0 )
											<button class="main_btn3" id="{{$item->idarticulo}}">AGOTADO :(</i>
											</button>
										@else
											<button class="main_btn" id="{{$item->idarticulo}}"
												onclick="enviar(this.id)">AGREGAR <i class=" fa fa-shopping-cart"></i>
											</button>
										@endif
									</div> 
	
								@endif
							
							</div>

							<div class="p-2"
								style="height: 80px; background: #f6f6f6;  border-radius: 0  0 10px 10px;">
								<div>
									<h6 id="proc{{$item->idarticulo}}" style="color: #33415C; ">
										{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}
									</h6>
								</div>
								<div class="block2 ">
									<h4 style="color: #BF0811;  font-size: 20px;">${{number_format($precio[1], 2, '.', ',')}} <small>	@if($item->descuento_art > 0) <del style="color : #023E7D; font-weight: bold; ">${{number_format($precio[0], 2, '.', ',')}}</del>
										@endif</small> </h4> 
								
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<div class="col-lg-1"></div>
				</div>
				<br><hr><br>
				<div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10" style="font-size: 16px;"><p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm"><b>El UPS</b> es la 
						combinación de supresor de energía, regulador de voltaje,  con el
						agregado que contiene una batería para proveer un <b> respaldo de
						energía </b> en el caso de cortes de energía eléctrica, el tiempo de respaldo
						de estos  se ve limitado por el consumo “carga” del
						aparato conectado y la capacidad de la batería del ups.
						</p>
						<p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
						El uso fundamental del ups es que de tiempo de apagar los aparatos
						eléctricos ante un corte de energía,  los usos mas comunes de estos
						es en <b>computadoras de escritorio</b>, <b>consolas de video juegos</b>,
						<b>video vigilancia</b>, <b>seguridad</b>,   para saber que tipo de
						ups necesitamos necesitamos saber la carga del aparato que vamos a
						conectar.</p>
						<p align="justify" style="margin-bottom: 0.35cm"><br/>
						<br/>
						
						</p>
						<table width="100%" class="table">
							<tr valign="top">
								<th width="50%">
									<p align="left"> Aparato 
									</p>
								</th>
								<th width="13%">
									<p align="center">Capacidad de UPS  
									</p>
								</th>
								<th width="19%">
									<p align="center">Rendimiento</p>
								</th>
							</tr>
							<tr valign="top">
								<td>
									<p align="justify">Computadora típica de escritorio “uso de
									oficina”  monitor de 17”</p>
								</td>
								<td>
									<p align="justify">500VA /  250Watt’s  
									</p>
								</td>
								<td>
									<p align="center">7 – 10 Minutos</p>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<p align="justify">Computadora típica de escritorio “uso de
									oficina”  monitor de 17”</p>
								</td>
								<td>
									<p align="justify">700VA /  350Watt’s 
									</p>
								</td>
								<td>
									<p align="center">9 – 15 Minutos</p>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<p align="justify">Computadora típica de escritorio “uso de
									oficina”  monitor de 17”</p>
								</td>
								<td>
									<p align="justify">1000VA /  500Watt’s 
									</p>
								</td>
								<td>
									<p align="center">20 – 30 Minutos</p>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<p align="justify">Router 
									</p>
								</td>
								<td>
									<p align="justify">1000VA /  500Watt’s 
									</p>
								</td>
								<td>
									<p align="center">5 horas </p>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<p align="justify">TV  42”  Led    PS4 
									</p>
								</td>
								<td>
									<p align="justify">1000VA /  500Watt’s</p>
								</td>
								<td>
									<p align="center"> 8 – 10 Minutos</p>
								</td>
							</tr>
						</table>
						<br><br>
						<h3>Comprar UPS</h3>
					</div>
					<div class="col-lg-1"></div>
				</div>
				<div class="row">
					<div class="col-lg-1"></div>
					@foreach ($productos3 as $item)
					@php $precio = precio($item, $varios) @endphp
					<div class="col-6  col-xl-2 col-lg-4 col-md-4 col-sm-6  p-0">
						<div class="single-product  m-2">
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

						
								@if (isset(auth('clients')->user()->nombre))            
									<div class="p_icon">
										@if ($item->stock <= 0 )
											<button class="main_btn3" id="{{$item->idarticulo}}">AGOTADO :(</i>
											</button>
										@else
											<button class="main_btn" id="{{$item->idarticulo}}"
												onclick="enviar(this.id)">AGREGAR <i class=" fa fa-shopping-cart"></i>
											</button>
										@endif
									</div> 
	
								@endif
							
							</div>

							<div class="p-2"
								style="height: 80px; background: #f6f6f6;  border-radius: 0  0 10px 10px;">
								<div>
									<h6 id="proc{{$item->idarticulo}}" style="color: #33415C; ">
										{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}
									</h6>
								</div>
								<div class="block2 ">
									<h4 style="color: #BF0811;  font-size: 20px;">${{number_format($precio[1], 2, '.', ',')}} <small>	@if($item->descuento_art > 0) <del style="color : #023E7D; font-weight: bold; ">${{number_format($precio[0], 2, '.', ',')}}</del>
										@endif</small> </h4> 
								
								</div>
							</div>
						</div>
					</div>
					@endforeach
					
					<div class="col-lg-1"></div>
					
				</div>
				<br>
				<div class="row">
					<div class="col-lg-1"></div>
					
					<div class="col-lg-10" style="font-size: 16px;"><p align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
					<b>Mini UPS  DC-DC</b> dispositivo ideal para trabajo 7/24 , respaldo de energia para pequeños aparatos como router, moden,  camara de seguridad etc.
					</p></div>
						
					<div class="col-lg-1"></div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-lg-1"></div>
					@foreach ($productos4 as $item)
					@php $precio = precio($item, $varios) @endphp
					<div class="col-6  col-xl-2 col-lg-4 col-md-4 col-sm-6  p-0">
						<div class="single-product  m-2">
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

						
								@if (isset(auth('clients')->user()->nombre))            
									<div class="p_icon">
										@if ($item->stock <= 0 )
											<button class="main_btn3" id="{{$item->idarticulo}}">AGOTADO :(</i>
											</button>
										@else
											<button class="main_btn" id="{{$item->idarticulo}}"
												onclick="enviar(this.id)">AGREGAR <i class=" fa fa-shopping-cart"></i>
											</button>
										@endif
									</div> 
	
								@endif
							
							</div>

							<div class="p-2"
								style="height: 80px; background: #f6f6f6;  border-radius: 0  0 10px 10px;">
								<div>
									<h6 id="proc{{$item->idarticulo}}" style="color: #33415C; ">
										{{$item->nombre .'  '.   $item->nombreModelo   .'  '.     $item->nombreMarca}}
									</h6>
								</div>
								<div class="block2 ">
									<h4 style="color: #BF0811;  font-size: 20px;">${{number_format($precio[1], 2, '.', ',')}} <small>	@if($item->descuento_art > 0) <del style="color : #023E7D; font-weight: bold; ">${{number_format($precio[0], 2, '.', ',')}}</del>
										@endif</small> </h4> 
								
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<div class="col-lg-1"></div>
				</div>
			</div><br><br>
		</div>
	</div>
</div>
</section>
@endsection