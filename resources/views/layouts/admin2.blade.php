<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <title>
                        @yield('title')
                    </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <!-- Latest compiled and minified CSS -->
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
    -->

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
        <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <!--    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"> -->
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('css/jquery-ui.theme.css')}}"> --}}
  {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"> --}}
  {{--<link rel="stylesheet" href="{{asset('css/jsp.css')}}"> --}}
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">

                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b></b>{{ config('constantes.ALIASMALL') }}</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>{{ config('constantes.ALIAS') }} </b></span>
                </a>


                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Navegación</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="{{url('/logout')}}" >
                              <!--      <small class="bg-red">Online</small> -->
                                    <span class="hidden-xs">Cerrar sesion</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->


                                    <!-- Menu Footer-->
                                    <li class="user-footer">

                                        <div class="pull-right">
                                            <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Cerrar</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>

                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header"></li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-barcode"></i>
                                <span>Productos</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('articulo')}}"><i class="fa fa-anchor"></i> Artículos</a></li>
                                <li><a href="{{url('categoria')}}"><i class="fa fa-circle-o"></i> Categorías</a></li>
                                <li><a href="{{url('marca')}}"><i class="fa fa-circle-o"></i> Marcas</a></li>
                                
                                <li><a href="{{url('articulo/reporte')}}"><i class="fa fa-anchor"></i>Reporte</a></li>

                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Compras</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('ingreso')}}"><i class="fa fa-caret-square-o-down"></i> Ingresos</a></li>
                                <li><a href="{{url('proveedor')}}"><i class="fa fa-child"></i> Proveedores</a></li>
                                <li><a href="{{url('ingreso/reporte')}}"><i class="fa fa-anchor"></i>Reporte Compras</a></li>


                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Ventas</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('venta')}}"><i class="fa fa-cart-arrow-down"></i> Ventas</a></li>
                                <li><a href="{{url('cliente')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                                <li><a href="{{url('venta/reporte')}}"><i class="fa fa-anchor"></i>Reporte Ventas</a></li>

                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Acceso</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('usuario')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>

                                <li><a href="{{url('controldefactura')}}"><i class="fa fa-circle-o"></i>Control de Factura</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-plus-square"></i> <span>Pendiente</span>
                              <!--  <small class="label pull-right bg-red">PDF</small> -->
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-info-circle"></i> <span>Soporte...</span>
                                <small class="label pull-right bg-yellow">IT</small>
                            </a>
                        </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>





            <!--Contenido-->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Main content -->
                <section class="content" style="background-color:white">

                    <div class="row">
                        <div class="col-md-12">
                                                           <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12" style="background-color:white">
                                            <!--Contenido-->
                                            @yield('contenido')
                                            <!--Fin Contenido-->
                                        </div>
                                    </div>

                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->
<!--<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 0.1
    </div>
    <strong>Copyright &copy; 2020 <a href="http://www.copipartes.com"> Copipartes</a>.</strong> All rights reserved.
</footer> -->

<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

@stack('scripts')
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script> -->
<!-- AdminLTE App -->
<script src="{{asset('js/app.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('js/jquery-ui.min.js')}}"></script>



{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

</body>
</html>
