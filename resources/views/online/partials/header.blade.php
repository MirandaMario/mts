<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="@yield('cdescripcion', 'Tienda Articulos informaticos, Audifonos, Impresoras, Memorias, El Salvador')"/> 
  <meta name="keywords" content="@yield('ckeyword', 'tienda informatica ,  online , baterias, adaptadores, teclado , mouse, combo teclado raton, caja de dinero, escaner codigo de barras , qr, impresoras termicas, ticketera, switch poe, fast ethernet, router, wifi, expansores de señal, gabinetes de red, soportes para monitor, soporte para proyector, domicilio, envios')"/>
  <meta property="og:title" content="@yield('ogTitle', 'MTECH TIENDA DE ARTICULOS INFORMATICOS')"/>
  <meta property="og:site_name" content="MTECH TIENDA DE ARTICULOS INFORMATICOS"/>
  <meta property="og:url" content="@yield('ogUrl', 'https://mtech-sv.com/')"/>
  <meta property="og:description" content="@yield('ogDesc' , 'Tienda Articulos informaticos OnLine, Audifonos, Impresoras, Memorias, Swicht,  El Salvador')"/>
  <meta property="og:type" content="@yield('ogType', 'website')"/>
  <meta property="og:image" content="@yield('ogImage')"/>
  <meta property="og:locale" content="es"/>
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title> @yield('title')</title>

  <link rel="stylesheet preload"  as="style" href={{ URL::asset("bootstrap45/css/bootstrap.min.css")}}/>          
  <link rel="stylesheet preload"  as="style" href={{ URL::asset("css/font-awesome.min.css")}}/>
  <link rel="stylesheet preload"  as="style" href={{ URL::asset("css/themify-icons.css")}} />
  <link rel="stylesheet prefetch" as="style" href={{ URL::asset("vendors/jquery-ui/jquery-ui.css")}}/>
  <link rel="stylesheet preload"  as="style" href={{ URL::asset("css/style.css") }}/>
  <link rel="stylesheet preload"  as="style" href={{ URL::asset("css/responsive.css")}} />
  <link rel="stylesheet preload"  as="style" href={{ URL::asset("css/floating-wpp.min.css")}}/>

  <style>
    .resizedTextbox {width: 50px; height: 30px}

    table tr td a {
    display:block;
    height:100%;
    width:100%;
}
table tr td {
    padding-left: 0;
    padding-right: 0;
}



  </style>

  <!-- Facebook Pixel Code -->
  <script>
    !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '278445859882652');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=278445859882652&ev=PageView&noscript=1" /></noscript>


 <!-- Global site tag (gtag.js) - Google Analytics -->
{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-192270853-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-192270853-1');
</script> --}}
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MTPQNX8BLP"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-MTPQNX8BLP');
</script>
   
</head>

{{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v7.0"
  nonce="OuyA7Pmx"></script> --}}

<body {{-- class="animsition" --}} id="midocumeto">
  <!-- Messenger plugin de chat Code -->
  <div id="fb-root"></div>

  <!-- Your plugin de chat code -->
 {{--  <div id="fb-customer-chat" class="fb-customerchat">
  </div>

  <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "106054784488363");
    chatbox.setAttribute("attribution", "page_inbox");

    window.fbAsyncInit = function() {
      FB.init({
        xfbml            : true,
        version          : 'v11.0'
      });
    };

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script> --}}
  @include('online.partials.modalart') 
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="float-left">
              <p>                
               @if (isset(auth('clients')->user()->nombre))
                  <a  href='{{ route('historial', ['id' => auth('clients')->user()->idpersona])}}'  style='color: white'> {{ auth('clients')->user()->nombre }}</a>
               @else
                  <a href='access' style='color: white'>Ingresar</a>
               @endif 
              <p>{!!isset(auth('clients')->user()->name) ? "<a href='./client/logout'  style='color: white'>&nbsp;&nbsp;cerrar sesion</a>" : 
              "<a href='./registrarse'  style='color: white'>&nbsp;&nbsp;Registrarse</a>"!!}</p>
              
              <p>El salvador</p>
            </div>
          </div>
          <div class="col-lg-5 d-none d-xl-block">
            <div class="float-right">
              <ul class="right_side">
                <li>
                  <a href="contactanos">
                    CONTACTANOS
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main_menu">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="./">
            <img src={{ URL::asset("imagenes/TT2.png")}} alt="logo" width="110%" height="60" />{{-- <span style="color:white ; font-size:25px;"
              class=" font-weight-bold">MTECH</span>  --}}
          </a>
          {{--CARRETILLA MODO MOVIL--}}
          @if (isset(auth('clients')->user()->nombre))
          <div class="d-block  d-md-block d-lg-none">
            <button class="btn btn-outline-"  data-toggle="modal"  data-target="#exampleModal" id="bmovil"> <b> <i class="ti-search" 
              style="color: white"></i></b> </button>
            <a href="./cart" class="icons">
              <i class="ti-shopping-cart cpa" title="VER ARTICULOS">{{Cart::session(auth('clients')->user()->idpersona)->getTotalQuantity()}}</i>
            </a>

            <a href="./checkout" class="icons">
              <i class="ti-money  tota" aria-hidden="true" title="PAGAR">{{Cart::session(auth('clients')->user()->idpersona)->getTotal()}}</i>
            </a>
          </div>

          @else
         
          <div class="d-block  d-md-block d-lg-none">
            <a  id="bmovil"  data-toggle="modal"  data-target="#exampleModal"> <i class="ti-search"
              style="color: white;  font-size: 20px;"></i> </a> 
            <a href="./cart" class="icons">
              <i class="ti-shopping-cart cpa" title="VER ARTICULOS">{{Cart::getTotalQuantity()}}</i>
            </a>
            <a href="./checkout" class="icons">
              <i class="ti-money  tota" aria-hidden="true" title="PAGAR">{{Cart::getTotal()}}</i>
            </a>
          </div>

          @endif
          <div class="d-block d-sm-block d-md-none pt-0" style='color: white;'>
            @if (isset(auth('clients')->user()->nombre))
                  <a  href='{{ route('historial', ['id' => auth('clients')->user()->idpersona])}}'  style='color: white'> {{strtok(strtoupper(auth('clients')->user()->nombre), " ")}}</a>
            @else
                  <a href='access' style='color: white'><b> <i class="ti-user"
                    style="color: white"></i></b>{{-- INGRESAR --}}</a>
            @endif  
            {{-- &nbsp;&nbsp;&nbsp;&nbsp;|| --}}
            {!!isset(auth('clients')->user()->name) ? "<a href='./client/logout' style='color: white;'>&nbsp;&nbsp;CERRAR SESION</a>" : 
              "<a href='./registrarse' style='color: white;'></a>"!!}
              
           {{--  {!!isset(auth('clients')->user()->name) ? "<a href='./client/logout' style='color: white;'>&nbsp;&nbsp;CERRAR SESION</a>" : 
              "<a href='./registrarse' style='color: white;'>&nbsp;&nbsp;REGISTRARSE</a>"!!} --}}
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
            <div class="row w-100 mr-0">
              <div class="col-lg-9 pr-0">
                <ul class="nav navbar-nav center_nav pull-right" >
                  <li class="nav-item submenu dropdown">
                    <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                      aria-haspopup="true" aria-expanded="false">Servicios PYMES</a>
                    <ul class="dropdown-menu">
                    
                      <li class="nav-item">
                        <a class="nav-link"  href="arrendamiento">Arrendamiento Multifuncionales</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="facturacion">Facturacion Inventario</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link"  href="tienda">Tienda en linea</a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item submenu dropdown" >
                    <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                      aria-haspopup="true" aria-expanded="false">Categorias</a>
                    <ul class="dropdown-menu " style="height:650%; overflow:hidden; overflow-y:scroll;">
                      @foreach ($categorias as $cat)
                      <li class="nav-item">
                        <a class="nav-link"
                          href="./{{$cat->cslug}}">{{strtoupper($cat->nombreCategoria)}}</a>
                      </li>
                      @endforeach
                    </ul>
                  </li>
                <div class="d-none d-sm-none d-md-none d-lg-block"> 
                  <br>
                <form class="form-inline my-2 my-lg-0 " action="./busqueda" method="GET" autocomplete="off">
                  <div class="input-group">
                    <input type="text" class="form-control resizedTextbox" placeholder="...buscar" name="str" id="findheader"   aria-label="buscar"
                      aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-" type="SUBMIT" id="button-addon2"> <b> <i class="ti-search"
                            style="color: white"></i></b> </button>
                            <div id="gitarticuloheader" style="position:absolute;"></div>
                    </div>
                    
                  </div>
                  
                </form>
              </div>
                </ul>
              </div>
              {{--MODO WEB--}}
              <div class="col-lg-3 pr-0 d-none d-sm-none d-md-none d-lg-block">
                @if (isset(auth('clients')->user()->nombre))
                <ul class="nav navbar-nav navbar-right right_nav pull-right ">
                  <li class="nav-item">

                    <a href="./cart" class="icons">
                      <i class="ti-shopping-cart cpa" title="VER ARTICULOS">{{Cart::session(auth('clients')->user()->idpersona)->getTotalQuantity()}}</i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./checkout" class="icons">
                      <i class="ti-money  tota" aria-hidden="true" title="PAGAR">{{Cart::session(auth('clients')->user()->idpersona)->getTotal()}}</i>
                    </a>
                  </li>
                </ul>  
                @else
                <ul class="nav navbar-nav navbar-right right_nav pull-right ">
                  <li class="nav-item">
                    <a href="./cart" class="icons">
                      <i class="ti-shopping-cart cpa" title="VER ARTICULOS">{{Cart::getTotalQuantity()}}</i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./checkout" class="icons">
                      <i class="ti-money  tota" aria-hidden="true" title="PAGAR">{{Cart::getTotal()}}</i>
                    </a>
                  </li>
                </ul> 
                @endif
              </div>
            </div>
          </div>
        </nav>
        <section class="feature-area section_gap_bottom_custom2" >
        <div class="container d-none d-sm-none d-md-none d-lg-block" style="max-width: 600px; position: absolute;">
        <table  id="ListaProductosHeader" class="table table-striped  table-hover table-sm"   WIDTH="90%" {{--  --}}>
        </table>
        </div>
      </section>
      </div>
    </div>
    <div id="espere_agregar" class="loader" style="display:none;">
    </div>   
  </div>
 </header>

