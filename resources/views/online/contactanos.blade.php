@extends('online.master')
@section('title','CONTACTANOS SUSCRIBETE')
@section('content')
<section>
    <div class="container" style="margin-top: 50px; ">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">CONTACTANOS</h2>
            </div>
            <div class="col-lg-8 mb-4 mb-lg-0">
                <form class="form-contact contact_form" action="mjs_save" method="post" id="contactForm"
                    novalidate="novalidate">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                    placeholder="ESCRIBA SU MENSAJE"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="name" id="name" type="text"
                                    placeholder="INGRESE SU NOMBRE" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <input class="form-control" name="email" id="email" type="email"
                                    placeholder="INGRESE SU CORREO ELECTRONICO">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="number" id="number" type="text"
                                    placeholder="INGRESE SU NUMERO DE TELEFONO">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text"
                                    placeholder="INGRESE EL ASUNTO DE SU MENSAJE EJP, COTIZACION COMPRA CONSULTA">
                            </div>
                        </div>
                        <div class="col-6 form-group ">
                            <button type="submit" id="boton_mjs" class="main_btn">ENVIAR</button>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check">
                            <label class="form-check-label" for="exampleCheck1">SUSCRIBETE PARA RECIBIR OFERTAS</label>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="col-lg-4">
                <div class="media contact-info pb-3">
                   <p align="justify" style="font-size:16px;"> Contactanos, puedes hacer tus cotizaciones, consultas, si necesitas una aplicacion o<strong> proyecto personalizado,</strong>
                    facturacion, inventario, cuentas por cobrar, cuentas por pagar, cotizaciones, libro de banco, etc, 
                    puedes describir lo que deseas, tu proyecto o <strong>modelo de negocio, </strong> para encontrar la mejor solucion,  <a href="./facturacion">mas informacion...</a> </p>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>SAN SALVADOR</h3>
                        <p>EL SALVADOR</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3><a href="tel:454545654">7779 3876</a></h3>
                        <p>Lunes a Sabado 8am - 6pm</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3><a href="mailto:support@colorlib.com">svmmtech@gmail.com</a></h3>
                        <p>¡Envíenos su consulta, cotizacion,  en cualquier momento!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection