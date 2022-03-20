<?php

Route::post('update_index_articulo', 'ArticuloController@update_index_articulo')->name('update_index_articulo');
Route::post('comprobar_slug_codigo', 'ArticuloController@comprobar_slug_codigo')->name('comprobar_slug_codigo');
Route::post('updatedstock', 'ArticuloController@updatedstock')->name('updatedstock');
Route::get('articulo/show3/{id}', 'ArticuloController@show3');
Route::get('articulo/vinetas','ArticuloController@vinetas');
Route::get('articulo/reporte','ArticuloController@reporte');
Route::get('articulo/rapdf','ArticuloController@rapdf');
Route::resource('articulo','ArticuloController');

Route::resource('mensaje','MensajeController');

Route::post('create_variante', 'VarianteController@create_variante')->name('create_variante');
Route::get('variante/variante', 'VarianteController@variante')->name('variante');
Route::resource('variante','VarianteController');


Route::resource('cart_estado','CartEstadoController');


Route::post('categoria/fetch', 'CategoriaController@storeAjax')->name('categoria.storeAjax');
Route::resource('categoria','CategoriaController');


Route::post('resolucion/fetch', 'ResolucionController@storeAjax')->name('resolucion.storeAjax');
Route::resource('resolucion','ResolucionController');


Route::post('modelo.porModelo', 'ModeloController@porModelo')->name('modelo.porModelo');
Route::post('modelo/fetchAjax', 'ModeloController@fetchAjax')->name('modelo.fetchAjax');
Route::post('modelo/fetch', 'ModeloController@storeAjax')->name('modelo.storeAjax');
Route::resource('modelo', 'ModeloController');

Route::resource('confonline', 'ConfOnlineController');

Route::resource('expediente', 'ExpedienteController');

Route::post('marca/fetchAjax', 'MarcaController@fetchAjax')->name('marca.fetchAjax');
Route::post('marca/fetch', 'MarcaController@storeAjax')->name('marca.storeAjax');
Route::resource('marca','MarcaController');

Route::post('porcentaje/fetch', 'PorcentajeController@storeAjax')->name('porcentaje.storeAjax');
Route::resource('porcentaje','PorcentajeController');


Route::post('cliente/fetch', 'ClienteController@storeAjax')->name('cliente.storeAjax');
Route::get('cliente/puntos/{id}', 'ClienteController@puntos');
Route::resource('cliente','ClienteController');
Route::post('proveedor/store', 'ProveedorController@storeAjax')->name('proveedor.storeAjax');
Route::resource('proveedor','ProveedorController');
Route::resource('tienda_conf','TiendaController');
Route::resource('tiendauser','TiendaUserController');

Route::resource('transferencia','TransferenciaController');
//Route::resource('ingresotienda','IngresoTiendaController');


Route::get('ingreso/rapdf','IngresoController@rapdf');
Route::get('ingreso/reporte','IngresoController@reporte');


Route::resource('ingreso','IngresoController');
Route::resource('pedido','PedidoController');


Route::get('salida/reporte','SalidaController@reporte');
Route::resource('salida','SalidaController');

Route::post('update_index_venta', 'VentaController@update_index_venta')->name('update_index_venta');
Route::post('ver_detalle_venta', 'VentaController@ver_detalle_venta')->name('ver_detalle_venta');
Route::get('venta/reimpresion/{id}', 'VentaController@reimpresion');
Route::get('venta/show4/{id}', 'VentaController@show4');
Route::get('venta/vineta/{id}', 'VentaController@vineta');
Route::resource('venta','VentaController');

Route::resource('cotizacion','CotizacionController');
Route::resource('configuracion','ConfiguracionController');
Route::get('corte/reimpresion/{id}', 'CorteController@reimpresion');
Route::resource('corte','CorteController');
Route::resource('controldefactura','ComprobanteController');
Route::resource('usuario','UsuarioController');
Route::resource('barcode','BarcodeController');


Route::resource('cuenta','CuentasController');
Route::get('transaccion/reporte', 'TransaccionesController@reporte');
Route::post('transaccion/fetch2', 'TransaccionesController@fetch2')->name('transaccion.fetch2');
Route::resource('transaccion', 'TransaccionesController');

/**AJAX **/
            /*COMPRAS */
Route::post('{id}/proveedor_ajax', 'BusquedaAjaxController@proveedor_ajax');
Route::post('proveedor_ajax', 'BusquedaAjaxController@proveedor_ajax'); 
Route::post('articulos_compras', 'BusquedaAjaxController@articulos_compras');
Route::post('{id}/articulos_compras', 'BusquedaAjaxController@articulos_compras');

            /*VENTAS */
Route::post('porModelo', 'ModeloController@porModelo')->name('porModelo');
Route::post('empresa', 'BusquedaAjaxController@empresa');
Route::post('{id}/empresa', 'BusquedaAjaxController@empresa');
Route::post('persona', 'BusquedaAjaxController@persona');
Route::post('{id}/persona', 'BusquedaAjaxController@persona');


Route::post('articulos_index', 'BusquedaAjaxController@articulos_index');
Route::post('articulos', 'BusquedaAjaxController@articulos');
Route::post('articulos_palabra', 'BusquedaAjaxController@articulos_palabra')->name('articulos_palabra');
Route::post('{id}/articulos', 'BusquedaAjaxController@articulos');/*edit*/
Route::post('articulo_codigo', 'BusquedaAjaxController@articulo_codigo');
Route::post('{id}/articulo_codigo', 'BusquedaAjaxController@articulo_codigo');

/*FIN RUTAS AJAX */

Route::resource('recover_password','PasswordRequestController');
//Route::post('reset/{code}', 'PasswordRequestController@reset');

Route::auth();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register/verify/{code}', 'GuestController@verify');


Route::get('articulos_header', 'OnLineController@articulos_header')->name('articulos_header');
Route::post('sol_reg', 'OnLineController@sol_reg')->name('sol_reg');
Route::post('mjs_save', 'OnLineController@mjs_save')->name('mjs_save');
Route::get('envios', 'OnLineController@envios')->name('envios');
Route::get('ingresar', 'OnLineController@ingresar')->name('ingresar');
Route::get('politicas', 'OnLineController@politicas')->name('politicas');
Route::get('buscar', 'OnLineController@buscar')->name('buscar');
Route::get('catalogo', 'OnLineController@index2')->name('catalogo');
Route::get('producto', 'OnLineController@show2')->name('producto');
Route::get('checkout', 'OnLineController@checkout')->name('checkout'); 
Route::get('cart', 'OnLineController@cart')->name('cart'); 
Route::post('save', 'OnLineController@save')->name('save'); 
Route::get('seguimiento', 'OnLineController@seguimiento')->name('seguimiento');
Route::get('contactanos', 'OnLineController@contactanos')->name('contactanos');
Route::get('facturacion', 'OnLineController@facturacion')->name('facturacion');
Route::get('tienda', 'OnLineController@tienda')->name('tienda');
Route::get('registrarse', 'OnLineController@registrarse')->name('registrarse');
Route::get('oferta', 'OnLineController@oferta')->name('oferta');
Route::get('premio', 'OnLineController@premio')->name('premio');
Route::get('marcas', 'OnLineController@marcas')->name('marcas');
Route::get('busqueda', 'OnLineController@busqueda')->name('busqueda');
Route::get('arrendamiento', 'OnLineController@arrendamiento')->name('arrendamiento');
Route::get('historial', 'OnLineController@historial')->name('historial');
Route::get('servicios', 'OnLineController@servicios')->name('servicios');
Route::get('/', 'OnLineController@index')->name('/');



//Route::resource('online', 'OnLineController');

Route::get('add', 'CartController@add')->name('add'); 
Route::get('ver', 'CartController@ver')->name('ver');
Route::get('remove', 'CartController@remove')->name('remove');
Route::get('clearcart', 'CartController@clearcart')->name('clearcart');
Route::get('update', 'CartController@update')->name('update'); 

Route::post('online.municipio', 'OnLineController@municipio')->name('online.municipio');
Route::post('lista_municipios', 'OnLineController@lista_municipios')->name('lista_municipios');

Route::get('access', 'ClientController@showLoginForm'); 
Route::post('access', 'ClientController@login'); 
Route::get('client/logout', 'ClientController@logout'); 

Route::get('{slug}', 'OnLineController@slug')->name('product');


