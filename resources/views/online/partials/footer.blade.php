<div class="modal fade" id="productoAgregado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3>Artículo agregado correctamente...</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 text-center">
            <img id="imagen" class="img-thumbnail" width="100" height="100">
          </div>
          <div class="col-md-8">
            <h4><span id="modalbody"></span></h4>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="{{route('/')}}" class="main_btn2" data-dismiss="modal" style="font-size: 11px;">Continuar
          Comprando</a>
        <a href="{{route('checkout')}}" class="main_btn" style="font-size: 11px;">Terminar
          Compra</a>

      </div>
    </div>
  </div>
</div>
<div id="myDiv"></div>
<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
  <div class="container">
    <div class="row" style="color: #979DAC;">
      <div class="col-lg-6 col-md-6 single-footer-widget">
        <h4>MTECH</h4>
        <ul>
          <li>SOMOS UNA TIENDA SALVADOREÑA DE TECNOLOGIA EN LINEA ORIENTADA A
            SERVIR PRODUCTOS DE CALIDAD</li>

          <li><i class="fa fa-truck " aria-hidden="true"></i> &nbsp;&nbsp; <a href="{{route('envios')}}"
              style="color:whitesmoke;">ENVIOS</a></li>
          <li><i class=" fa fa-check" aria-hidden="true"></i> &nbsp;&nbsp; <a href="{{route('politicas')}}"
              style="color:whitesmoke;">TERMINOS Y CONDICIONES</a></li>
          <li><i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;&nbsp; <a href="{{route('facturacion')}}"
              style="color:whitesmoke;">FACTURACION E INVENTARIO</a></li>
          <li><i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp;&nbsp; <a href="{{route('tienda')}}"
              style="color:whitesmoke;">TIENDA</a></li>

        </ul>

      </div>

      <div class="col-lg-3 col-md-6 single-footer-widget">
        <h4><a href="{{route('contactanos')}}" style="color:whitesmoke;">
            CONTACTANOS
          </a></h4>
        <ul>
          <li><a href="https://api.whatsapp.com/send?phone=50378850507" style="color: #979DAC;"><i
            class="fa fa-whatsapp" aria-hidden="true" style="color: chartreuse;"></i> &nbsp;&nbsp; 7885 0507</a> </li>
          <li><a href="https://api.whatsapp.com/send?phone=50377793876" style="color: #979DAC;"><i
                class="fa fa-whatsapp" aria-hidden="true" style="color: chartreuse;"></i> &nbsp;&nbsp; 7779 3876</a>
          </li>
          <li><a href="mailto:svmmtech@gmail.com"><i class="fa fa-envelope-o" aria-hidden="true"></i> </a> &nbsp;&nbsp;<a href="mailto:svmmtech@gmail.com">svmmtech@gmail.com</a>  </li>

        </ul>

      </div>

      <div class="col-lg-3 col-md-12 footer-social ">
        <h4><a href="{{route('seguimiento')}}" style="color:whitesmoke;">SEGUIMIENTO DE PEDIDO</a></h4>
        {{-- <div class="footer-bottom row align-items-center"> --}}
          <br>
        <ul >

          <a href="https://www.facebook.com/mmtechsv/" target=" _blank"><i class="fa fa-facebook fa-lg"
              style="color:#7d8597;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="https://www.instagram.com/mtech.sv/" target=" _blank"><i class="fa fa-instagram fa-lg"
              style="color:#7d8597;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
          {{-- <i class="fa fa-twitter fa-lg"></i> &nbsp;&nbsp; --}}
          <img src={{ URL::asset("images/vm.png")}} alt="" height="30" /><span style="color:white ; font-size:25px;"
              class=" font-weight-bold">
          {{-- <i class="fa fa-cc-visa       fa-2x"></i>&nbsp;&nbsp;
          <i class="fa fa-cc-mastercard fa-2x"></i>&nbsp;&nbsp; --}}
        </ul>
        <br>
        <div class="fb-like" data-href="https://www.facebook.com/mmtechsv/" data-width="" data-layout="button"
          data-action="like" data-size="small" data-share="true"></div>
        <div class="footer-bottom row ">
          <p class="footer-text col-lg-12 col-md-12 ">

            Copyright &copy; {{date('Y')}} All rights reserved
          </p>
          <p>
            79Av. Norte y 9ª. Calle Pte, Centro Comercial Vía Miranda Local 9, San Salvador 
          </p>
        </div>
      </div>
        <div>
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15504.911829734694!2d-89.2363732!3d13.704639!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x15e2c9245edea1ef!2sMTECH%20TIENDA%20INFORMATICA%20ONLINE!5e0!3m2!1ses-419!2ssv!4v1608708348967!5m2!1ses-419!2ssv" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        
    </div>


    @isset($mensaje)
    <input type="hidden" id="mensaje2" value="{{ $mensaje }}">
    @endisset

    @if ($message = Session::get('success'))
    <input type="hidden" id="mensaje" value="{{ $message }}">
    @endif

    @isset($mjsn)
    <input type="hidden" id="mjsn" value="{{ $mjsn }}">
    @endisset
</footer>
<!--================ End footer Area  =================-->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/floating-wpp.min.js')}}"></script>
<script src="{{asset('bootstrap45/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/counter-up/jquery.counterup.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('js/theme.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/contact.js')}}"></script>
</body>

</html>