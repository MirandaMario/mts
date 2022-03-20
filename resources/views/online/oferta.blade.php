@extends('online.master')
@section('title', 'Productos en oferta')
@section('content')
    <!-- SECTION -->
    <div class="container " style="max-width: 1500px; ">
        <br>
        <div class="row flex-row-reverse">
            <div class="col-lg-12">
                <div class="product_top_bar border">
                    PRODUCTOS CON DESCUENTO
                </div>
                <br>
                <div class="latest_product_inner">
                    <div class="row">
                        @foreach ($productos as $item)
                            @php $precio = precio($item, $varios) @endphp
                            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 p-0">
                                <div class="single-product  m-2"
                                style="/* border-radius: 10px; box-shadow: 3px 3px 20px rgba(0, 0, 0, .5); */ padding-top: 2px;">
                                    <div class="text-right"><span> <b> DESCUENTO {{ $item->descuento_art }}% </b> </span>
                                        &nbsp;&nbsp;</div>
                                    <div class="product-img">
                                        <div class="inner">
                                            <a href="{{ route('product', [$item->slug]) }}">
                                                @if ($item->imagen1 != null)
                                                    <img class="card-img-top"
                                                        src="{{ asset('imagenes/articulos/' . $item->imagen1) }}"
                                                        alt="{{ $item->nombre . '  ' . $item->nombreModelo }}">
                                                @else
                                                    <img class="card-img-top"
                                                        src="{{ asset('imagenes/articulos/patucel.jpg') }}" alt="">
                                                @endif
                                            </a>

                                        </div>
                                        <input type="hidden" id="slug{{ $item->idarticulo }}" value="{{ $item->slug }}">
                                        <input type="hidden" id="imgp{{ $item->idarticulo }}" value="{{ $item->imagen1 }}">
                                        <input type="hidden" id="prec{{ $item->idarticulo }}"
                                            value="{{ number_format($precio[1], 2, '.', ',') }}">
                                        <input type="hidden" id="cant{{ $item->idarticulo }}" value="1">
                                        <input type="hidden" id="desc{{ $item->idarticulo }}"
                                            value="{{ $item->descuento_art }}">
                                        @if (isset(auth('clients')->user()->nombre))
                                            {{-- <div class="p_icon">
                                                @if ($item->stock <= 0)
                                                    <button class="main_btn3" id="{{ $item->idarticulo }}">AGOTADO :(</i>
                                                    </button>
                                                @else
                                                    <button class="main_btn" id="{{ $item->idarticulo }}"
                                                        onclick="enviar(this.id)">AGREGAR <i
                                                            class=" fa fa-shopping-cart"></i>
                                                    </button>
                                                @endif
                                            </div> --}}
                                        @endif
                                    </div>

                                    <div class="p-2"
                                        style="height: 120px; background: #f6f6f6;  border-radius: 0  0 10px 10px;">
                                        <div>
                                            <h6 id="proc{{ $item->idarticulo }}" style="color: #33415C; ">
                                                {{ $item->nombre . '  ' . $item->nombreModelo . '  ' . $item->nombreMarca }}
                                            </h6>
                                        </div>

                                        <div class="block2">
                                            <h4>${{ number_format($precio[1], 2, '.', ',') }} <small>
                                                    @if ($item->descuento_art > 0)
                                                        <del
                                                            style="color : #023E7D; font-weight: bold; ">${{ number_format($precio[0], 2, '.', ',') }}</del>
                                                    @endif
                                                </small></h4>

                                        </div>
                                    </div>
                                    {{-- <div class="block3"
                                        style="text-align: right;  p-b 0;  position: absolute; bottom:10px;">
                                        @if ($item->stock == 0)
                                            <h6 style="color: red">TEMPORALMENTE AGOTADO</h6>
                                            @else
                                            <h6 style="color: green">EN STOCK</h6>
                                        @endif
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div><br><br>
                <div class="store-pagination">
                    <div class="custom-pagination-brand-blue">
                        {{ $productos->appends(['id' => $idcat, 'id2' => $idmar])->links() }}
                    </div>
                </div>
                <div>
                    @if ($productos->count() == 0)
                        <br>
                        <P> NO SE ENCUENTRAN PRODUCTOS RELACIONADOS CON SUS CRITERIOS DE BUSQUEDA... PRUEBE CON OTRA
                            COMBINACION
                            :) </P>

                    @endif
                    MOSTRANDO {{ $productos->count() }} DE {{ $productos->total() }}
                </div>
            </div>
        </div>
    </div>

    </section>

@endsection
