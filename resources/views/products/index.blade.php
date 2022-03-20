@extends('products.master')
@section('content')
@include('products.modal')
<style>

 /*    img {
        display: flex;
        margin: 0 auto;
    } */
</style>
<div class="row">
SASASA
    <div class="col-lg-3">
        <h5>&nbsp;</h5>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Categorias</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        @foreach($categorias as $categoria)
                        <option value="{{$categoria->idCategoria}}">{{$categoria->nombreCategoria}}</option>
                        @endforeach
                    </select>
                </div>
                @php
                 dump($marcas)
                @endphp
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Marcas</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        @foreach($marcas as $marca)
                        <option value="{{$marca->idMarca}}">{{$marca->nombreMarca}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block img-fluid" src="{{ asset("imagenes/articulos/c3.png")  }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="{{ asset("imagenes/articulos/c3.png")  }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="{{ asset("imagenes/articulos/c3.png")  }}" alt="Third slide">
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
        
        <div class="row">
            @foreach ($productos as $item)
            <div class="col-lg-3 col-md-6 mb-4 ">
                <div class="card h-100 ">
                    <a href="#"><img class="card-img-top" src="{{ asset("imagenes/articulos/".$item->imagen)  }}"
                            alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">{{$item->nombre}} <br> {{$item->nombreModelo}}</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">{{$item->descripcion}}</p>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" {{-- data-target="#staticBackdrop" --}}>
                           VER
                          </button> <br>

                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>
                          
                           {{-- <a href="#" class="btn btn-primary">Ver</a> --}}
        {{--                 <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
       {{--  {{$productos->links() }} --}}
        <!-- /.row -->
    </div>
    <!-- /.col-lg-9 -->
</div>
@endsection