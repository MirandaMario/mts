<div>
    <br><br>
    <table border="1" style="margin: auto;  border-collapse: collapse;">
        <thead>
            <tr>
              <td class="tg-0pky" colspan="2" style="text-align:center;"><img src="./../../imagenes/america.jpg" alt=""    style="height: 75px;" ></td>
            </tr>
        </thead> 

        <tbody>
            <tr>
              <td class="tg-0pky"  style="text-align:left;"><b>Cliente</b> </td>
              <td class="tg-0pky" ><b>{{$venta->nombre}}</b></td>
            </tr>
    
            <tr>
              <td class="tg-0pky"  ><b>Teléfono</b></td>
              <td class="tg-0pky">{{$venta->tel}}</td>
            </tr>

            <tr>
              <td class="tg-0pky" ><b>Monto</b></td>
              <td class="tg-0pky">$ {{$venta->total_venta + $venta->envio }}</td>
            </tr>
          
            <tr>
              <td class="tg-0pky" rowspan="3"><b> Dirección</b> </td>
              <td class="tg-0pky" colspan="2" rowspan="3">{{$venta->direccion}} , {{$venta->municipio}} , {{$venta->departamento}}</td>
            </tr>        
          </tbody>
    </table>
</div>