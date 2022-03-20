<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            @foreach ($productos as $item)
          <h5 class="modal-title" id="exampleModalCenterTitle">{{$item->nombre}} <br> {{$item->nombreModelo}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                  <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="card-img-top" src="{{ asset("imagenes/articulos/".$item->imagen)  }}"
                            alt="">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>primera</h5>
                      <p>Parte frontal.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="card-img-top" src="{{ asset("imagenes/articulos/".$item->imagen)  }}"
                            alt="">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>segunda</h5>
                      <p>parte trasera.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="card-img-top" src="{{ asset("imagenes/articulos/".$item->imagen)  }}"
                            alt="">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>tercera</h5>
                      <p>para tu comodidad</p>
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>

            {{$item->descripcion}}

         
        @endforeach
        </div>

        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
       {{--    <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @foreach ($productos as $item)
              <h5 class="modal-title" id="exampleModalCenterTitle">{{$item->nombre}} {{$item->nombreModelo}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active"> <img class="card-img-top" src="{{ asset("imagenes/articulos/".$item->imagen)  }}"
                        alt="50"> <div class="carousel-caption d-none d-md-block">
                          <h5>primera</h5>
                          <p>Parte frontal.</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="card-img-top" src="{{ asset("imagenes/articulos/".$item->imagen)  }}"
                        width="125" height="85">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>segunda</h5>
                          <p>parte trasera.</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="card-img-top" src="{{ asset("imagenes/articulos/".$item->imagen)  }}"
                        alt="50">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>tercera</h5>
                          <p>para tu comodidad</p>
                        </div>
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                {{$item->descripcion}}
                @endforeach
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
             {{--  <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>

    </div>
  </div>