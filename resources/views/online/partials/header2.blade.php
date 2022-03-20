<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />

  <title>
    @yield('title')
  </title>
  <!-- Bootstrap CSS -->
  {{--   <link rel="stylesheet" href="css/bootstrap.css" /> --}}
  <link rel="stylesheet" href="bootstrap45/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/linericon/style.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="css/flaticon.css" />
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css" />
  <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
  <link rel="stylesheet" href="vendors/animate-css/animate.css" />
  <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="css/animsition.min.css">
  <!-- main css -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
</head>

<body {{-- class="animsition" --}}>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="float-left">
              <p>TEL: 7566 5507</p>
              <p>email: soporte@mtech-sv.com</p>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="float-right">
              <ul class="right_side">

                <li>
                  <a href="contact.html">
                    Contactanos
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
          <a class="navbar-brand logo_h" href="./"> <span> MTECH</span> <img src="img/89.png"
              style="height: 60px; width: 60%;">

          </a>
          <div class="d-block d-md-block d-lg-none">
            <a href="./cart" class="icons">
              <i class="ti-shopping-cart cpa" title="VER ARTICULOS">{{Cart::getTotalQuantity()}}</i>
            </a>

            <a href="./checkout" class="icons">
              <i class="ti-money  tota" aria-hidden="true" title="PAGAR">{{Cart::getTotal()}}</i>
            </a>
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
              <div class="col-lg-10 pr-0">
                <ul class="nav navbar-nav center_nav pull-center">
                  <li class="nav-item active">
                    <a class="nav-link" href="./">Home</a>
                  </li>
                  <a href="#" class="icons2" title="IMPRESORAS">
                    <i class="fa fa-print" aria-hidden="true"></i>
                  </a>&nbsp;&nbsp;
                  <a href="#" class="icons2" title="AUDIFONOS">
                    <i class="fa fa-headphones" aria-hidden="true"></i>
                  </a>&nbsp;&nbsp;
                  <a href="#" class="icons2" title="MONITORES">
                    <i class="fa fa-desktop" aria-hidden="true"></i>
                  </a>&nbsp;&nbsp;
                  <a href="#" class="icons2" title="RATONES">
                    <i class="fa fa-mouse-pointer" aria-hidden="true"></i>
                  </a>&nbsp;&nbsp;
                  <a href="#" class="icons2" title="TECLADOS">
                    <i class="fa fa-keyboard-o" aria-hidden="true"></i>
                  </a>&nbsp;&nbsp;

                </ul>
              </div>
              <div class="col-lg-2 pr-0 d-none d-sm-none d-md-none d-lg-block">
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
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!--================Header Menu Area =================-->
  {{--   @include('layouts.message2') --}}


  <!-- /NAVIGATION -->