<?php

if ($idcategoria > 0){   //FILTRANDO POR CATEGORIA 
        $top25  = DB::select('select  a.idarticulo
        ,a.nombre as nombrearticulo
        ,a.codigo
        ,nombreModelo
        ,nombreCategoria
        ,SUM(dv.cantidad) as cantidadav
        ,SUM(dv.cantidad * dv.precio_venta) as ingreso 
        ,v.fecha_hora 
        ,(SELECT SUM(di.cantidad * di.precio_compra ) FROM detalle_ingreso as di WHERE idarticulo  = a.idarticulo) media
        ,(SELECT SUM(di.cantidad )                    FROM detalle_ingreso as di WHERE idarticulo  = a.idarticulo) total_elemmentos_comprados
    
    from        articulo  a

        join modelo                  md  on  a.idModelo      =  md.idModelo
        join categoria                c  on  a.idcategoria   =   c.idcategoria
        left join detalle_venta   as dv  on  a.idarticulo    =  dv.idarticulo
        left join venta           as  v  on  dv.idventa      =   v.idventa
         
        where  v.fecha_hora between "'.$query.'%'.'" and "'.$query2.'%'.'" 
        and a.idcategoria = '.$idcategoria.'
        group by  idarticulo;');



        $agrupacion_categoria  = DB::select('select  a.idarticulo
   
        ,nombreCategoria
        ,SUM(dv.cantidad) as cantidadav
        ,SUM(dv.cantidad * dv.precio_venta) as ingreso 
        ,v.fecha_hora 


    from articulo  a

        join categoria                c  on  a.idcategoria   =   c.idcategoria
        left join detalle_venta   as dv  on  a.idarticulo =  dv.idarticulo
        left join venta           as  v  on  dv.idventa   =   v.idventa

        where  v.fecha_hora between "'.$query.'%'.'" and "'.$query2.'%'.'"        
        group by  nombreCategoria ;');   
        
        
} else {
   
    $top25  = DB::select('select  a.idarticulo
        ,a.nombre as nombrearticulo
        ,a.codigo
        ,nombreModelo
        ,nombreCategoria
        ,SUM(dv.cantidad) as cantidadav
        ,SUM(dv.cantidad * dv.precio_venta) as ingreso 
        ,v.fecha_hora 
        ,(SELECT SUM(di.cantidad * di.precio_compra ) FROM detalle_ingreso as di WHERE idarticulo  = a.idarticulo) media
        ,(SELECT SUM(di.cantidad )                    FROM detalle_ingreso as di WHERE idarticulo  = a.idarticulo) total_elemmentos_comprados

    from articulo  a
        join modelo                  md  on  a.idModelo   =  md.idModelo
        join categoria                c  on  a.idcategoria   =   c.idcategoria
        left join detalle_venta   as dv  on  a.idarticulo =  dv.idarticulo
        left join venta           as  v  on  dv.idventa   =   v.idventa

        where  v.fecha_hora between "'.$query.'%'.'" and "'.$query2.'%'.'" 
        group by  idarticulo;');  


        $agrupacion_categoria  = DB::select('select  a.idarticulo
     
        
        ,nombreCategoria
        ,SUM(dv.cantidad) as cantidadav
        ,SUM(dv.cantidad * dv.precio_venta) as ingreso 
        ,v.fecha_hora 
       

    from articulo  a
      
        join categoria                c  on  a.idcategoria   =   c.idcategoria
        left join detalle_venta   as dv  on  a.idarticulo =  dv.idarticulo
        left join venta           as  v  on  dv.idventa   =   v.idventa

        where  v.fecha_hora between "'.$query.'%'.'" and "'.$query2.'%'.'" 
        group by  nombreCategoria;');       
}

   


if ($cesc == 1) {
    // dd($cesc);
    $ventas = DB::table('venta as v')
        ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
        ->leftjoin('detalle_venta as dv', 'v.idventa', 'dv.idventa')
        ->join('articulo as a', 'a.idarticulo', 'dv.idarticulo')
        ->join('modelo as m', 'a.idModelo', 'm.idModelo')
        ->select('v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.estado', 'v.num_comprobante', 'v.idtienda', 'a.nombre as nombrearticulo',
            'a.costoProducto', 'dv.precio_venta', 'm.nombreModelo', 'dv.cantidad'
            /*  ,DB::raw('SUM(((dv.precio_venta * dv.cantidad) - ((dv.precio_venta * dv.cantidad) * (dv.descuento / 100)))) as  total_venta') */)
        ->where('a.impuestodos', 1)
        ->where('v.idtienda', $idtienda)
        ->where('v.tipo_comprobante', 'LIKE', '%' . $query3 . '%')
        ->whereBetween('fecha_hora', [$query, $query2])
    // ->groupBy('v.idventa')
        ->orderBy('num_comprobante', 'desc')
        ->get();
} else{
    if ($tipo !=  '%' ) {          //tipo de articulo
        if ($query3 == 'FC') {      //filtra facturas y ccfs
            if ($idcategoria > 0) {
                $ventas = DB::table('venta as v')
                ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
                ->leftjoin('detalle_venta as dv', 'v.idventa', 'dv.idventa')
                ->join('articulo as a', 'a.idarticulo', 'dv.idarticulo')
               // ->join('categoria as c' , 'a.idcategoria', 'c.idcategoria')
                ->join('modelo as m', 'a.idModelo', 'm.idModelo')
                ->join('detalle_ingreso as di', 'a.idarticulo', 'di.idarticulo')        
                ->select('v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.estado', 'v.num_comprobante', 'v.idtienda', 'a.nombre as nombrearticulo',
                    'a.costoProducto', 'dv.precio_venta', 'm.nombreModelo', 'dv.cantidad'  , DB::raw('(SUM(di.precio_compra * di.cantidad)  /   SUM(di.cantidad )) as promedio'))
    
                ->where('a.tipo', $tipo)
                ->where('a.idcategoria', $idcategoria)
                ->where('v.idtienda', $idtienda)
                ->where(function ($query2)  {
                    $query2->orwhere('v.tipo_comprobante', 2 );
                    $query2->orwhere('v.tipo_comprobante', 3);
                })
                ->whereBetween('fecha_hora', [$query, $query2])
                ->groupBy('dv.iddetalle_venta')
                ->orderBy('num_comprobante', 'desc')
                ->get();
            } else {
                $ventas = DB::table('venta as v')
                ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
                ->leftjoin('detalle_venta as dv', 'v.idventa', 'dv.idventa')
                ->join('articulo as a', 'a.idarticulo', 'dv.idarticulo')
                ->join('modelo as m', 'a.idModelo', 'm.idModelo')
                ->join('detalle_ingreso as di', 'a.idarticulo', 'di.idarticulo')        
                ->select('v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.estado', 'v.num_comprobante', 'v.idtienda', 'a.nombre as nombrearticulo',
                    'a.costoProducto', 'dv.precio_venta', 'm.nombreModelo', 'dv.cantidad'  , DB::raw('(SUM(di.precio_compra * di.cantidad)  /   SUM(di.cantidad )) as promedio'))
    
                ->where('a.tipo', $tipo)
                ->where('v.idtienda', $idtienda)
                ->where(function ($query2)  {
                    $query2->orwhere('v.tipo_comprobante', 2 );
                    $query2->orwhere('v.tipo_comprobante', 3);
                })
                ->whereBetween('fecha_hora', [$query, $query2])
                ->groupBy('dv.iddetalle_venta')
                ->orderBy('num_comprobante', 'desc')
                ->get();
            }
            
            
           

        }else{                      //filtra elementos separados                     
            $ventas = DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->leftjoin('detalle_venta as dv', 'v.idventa', 'dv.idventa')
            ->join('articulo as a', 'a.idarticulo', 'dv.idarticulo')
            ->join('modelo as m', 'a.idModelo', 'm.idModelo')
            ->join('detalle_ingreso as di', 'a.idarticulo', 'di.idarticulo')        
            ->select('v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.estado', 'v.num_comprobante', 'v.idtienda', 'a.nombre as nombrearticulo',
                'a.costoProducto', 'dv.precio_venta', 'm.nombreModelo', 'dv.cantidad'  , DB::raw('(SUM(di.precio_compra * di.cantidad)  /   SUM(di.cantidad )) as promedio'))

            ->where('a.tipo', $tipo)
            ->where('v.idtienda', $idtienda)
            ->where('v.tipo_comprobante', 'LIKE', '%' . $query3 . '%')
            ->whereBetween('fecha_hora', [$query, $query2])
            ->groupBy('dv.iddetalle_venta')
            ->orderBy('num_comprobante', 'desc')
            ->get();
        }
        

     } else { 
        $ventas = DB::table('venta as v')
        ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
        ->leftjoin('detalle_venta as dv', 'v.idventa', 'dv.idventa')
        ->join('articulo as a', 'a.idarticulo', 'dv.idarticulo')
        ->join('modelo as m', 'a.idModelo', 'm.idModelo')
        ->join('detalle_ingreso as di', 'a.idarticulo', 'di.idarticulo')        
        ->select('v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.estado', 'v.num_comprobante', 'v.idtienda', 'a.nombre as nombrearticulo',
            'a.costoProducto', 'dv.precio_venta', 'm.nombreModelo', 'dv.cantidad',  DB::raw('(SUM(di.precio_compra * di.cantidad)  /   SUM(di.cantidad )) as promedio'))
        //->where('a.tipo', $tipo)
        ->where('v.idtienda', $idtienda)
        ->where('v.tipo_comprobante', 'LIKE', '%' . $query3 . '%')
        ->whereBetween('fecha_hora', [$query, $query2])
        ->groupBy('dv.iddetalle_venta')
        ->orderBy('num_comprobante', 'desc')
        ->get();
     }
   }
   
    
$data = [
    "ventas" => $ventas,
    "request" => $request,
    "top25" => $top25,
    "agrupacion_categoria" => $agrupacion_categoria,
];
