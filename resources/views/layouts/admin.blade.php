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
    <link rel="stylesheet" href="{{asset('bootstrap337/css/bootstrap.min.css')}}">
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
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.dataTables.min.css')}}">
    <style>
           a:hover {
    background-color: rgb(0, 0, 0) !important;
    color:#39ff14  !important;
}
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <div class="wrapper fixed">
        <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b></b>{{ config('constantes.ALIASMALL') }}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>{{ config('constantes.ALIAS') }} </b> </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Navegación</span>
                </a>
                <a href="{{url('/articulo')}}"><button class="btn btn-primary navbar-btn btn-sm" id="articulos"
                        type="button"><b>ARTICULOS</b></button></a>
                @if (auth()->user()->rol == 1)
                <a href="{{url('/ingreso')}}"> <button class="btn btn-primary navbar-btn btn-sm" id="compra"
                        type="button"><b>&nbsp;&nbsp;COMPRAS&nbsp;&nbsp;</b></button></a>
                @endif

                <a href="{{url('/venta')}}"> <button class="btn btn-primary navbar-btn btn-sm" id="ventabtn"
                        type="button"><b>&nbsp;&nbsp;&nbsp;VENTA&nbsp;&nbsp;&nbsp;</b></button></a>

                <a href="{{url('/home')}}" style="color: white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-remove-sign " ></i>
                </a>
                            
                <div class="col-sm-3 col-md-3 pull-right">
                    <form class="navbar-form" role="search"   action="{{url('/articulo')}}" id="form_index_header" >
                        {{Form::token()}}
                        <div class="input-group">
                           
                            <input type="text"  name="texto" id="articulo_index_header" size="15" placeholder="articulo..."  autocomplete="off" class="form-control" style="font-family: Arial; font-size: 15pt; color : black; ">
                              <input type="hidden" name="buscar" id="buscar" value="buscar">
                             
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                <span id="gitarticulo_header" style="position: absolute; "></span> 
                            </div>
                           
                        </div>
                    </form>
                </div>  
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="{{url('/home')}}" class="hidden-xs">
                                <!--      <small class="bg-red">Online</small> -->
                                <span >{{ auth()->user()->name }}&nbsp;&nbsp;&nbsp;{{ auth()->user()->id_tienda }} </span>
                                <span >Cerrar sesion</span>    
                            </a>
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
                <div class="visible-xs">
                    <br><br><br>
                </div>
                <ul class="sidebar-menu">
                    <li class="header"></li>
                    @if (auth()->user()->rol == 1)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-barcode size: 7x" id="varios"></i>
                            <span>Varios</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('proveedor')}}"><i class="fa fa-child"></i> Proveedores</a></li>
                            <li><a href="{{url('cliente')}}"><i class="fa fa-users" aria-hidden="true"></i>Paciente/Responsable</a>
                            <li><a href="{{url('marca')}}"><i class="fa fa-circle-o"></i> Marcas </a></li>
                            <li><a href="{{url('categoria')}}"><i class="fa fa-circle-o"></i> Categorías</a></li>
                            <li><a href="{{url('modelo')}}"><i class="fa fa-circle-o"></i> Modelos</a></li>
                          
                    </li>
                </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>Reportes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('articulo/reporte')}}"><i class="fa fa-bars"
                                    aria-hidden="true"></i>Artículos</a></li>
                        <li><a href="{{url('ingreso/reporte')}}"><i class="fa fa-bars"
                                    aria-hidden="true"></i>Compras</a></li>
                        <li><a href="{{url('corte')}}"><i class="fa fa-bars" aria-hidden="true"></i>Ventas</a></li>
                    </ul>
                </li>

              

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa fa-cogs size: 7x" id="conf"></i>
                        <span>Configuraciones</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('tienda_conf')}}"><i class="fa fa-child">                   </i>Tienda      </a></li>
                        <li><a href="{{url('usuario')}}">    <i class="fa fa-users" aria-hidden="true"></i>Usuarios    </a></li>
                        {{-- <li><a href="{{url('confonline')}}"> <i class="fa fa-cogs"  aria-hidden="true"></i>OnLine      </a></li> --}}
                        <li><a href="{{url('resolucion')}}"> <i class="fa fa-cogs"  aria-hidden="true"></i>Resoluciones</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>Abono</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('articulo/reporte')}}"><i class="fa fa-bars" aria-hidden="true"></i>Abono</a></li>
                                    
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"  >
                        <i class="fa fa-th" id="expediente"></i>
                        <span>Expediente</span>
                        <i class="fa fa-angle-left pull-right"  ></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('expediente')}}" ><i class="fa fa-bars" aria-hidden="true"></i>Expediente</a></li>
                                    
                    </ul>
                </li>
                @endif
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        
        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper"   {{-- style="padding: 40px 0px 0px 0px;" --}}  {{--  style="background-image: url('{{asset('imagenes/patucell.jpg')}}'); " --}}>
            <!-- Main content -->
            <section class=" content">
                @include('layouts.message')
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pa">
                    </div> 
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pa">
                        <div class="visible-xs">
                            <br><br><br>
                        </div>
                        <div  id="ListaProductos_header"  style="position: absolute; text-align:right;"></div>
                    </div>
                    <div class="visible-xs">
                        <br><br><br>
                    </div>
                    
                    <!-- /.box-header -->
                    <!--Contenido-->
                    @yield('contenido')
                    <!--Fin Contenido-->

                </div><!-- /.row -->
            </div><!-- /.box-body -->
            </section><!-- /.content -->
        </div><!-- /.box -->
        {{--  <footer class="main-footer"> --}}
        {{-- <div class="pull-right hidden-xs">
            <b>Version</b> 0.1
        </div>
        <strong>Copyright &copy; 2020 <a href="http://www.copipartes.com"> Copipartes</a>.</strong> All rights reserved.
    </footer> --}}
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    <!-- jQuery 2.1.4 -->
    @stack('scripts')
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/venta/helper.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.responsive.min.js')}}"></script>
    <script>
        $('#myTable , #myTable2, #myTable3').DataTable({
            "order": [[ 0, "desc" ]],
            "aLengthMenu": [[15, 25, 50, 75, -1], [15, 25, 50, 75, "All"]],
            "iDisplayLength": 15,
            language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
    </script>
    <script src="{{asset('bootstrap337/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/app.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
  
    
</body>

</html>