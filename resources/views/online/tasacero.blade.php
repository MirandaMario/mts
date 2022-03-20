@if ($precio[1] >= 35 )
<h4> Tasa cero con tarjeta de crédito Banco Agrícola </h4><br><br>
<div class="row">
   
   <div class="col-xs-* col-lg-6 col-sm-5">
       <img src={{ URL::asset("images/lba.png")}} alt="" height="75" />
      
   </div>
   <div class="col-xs-* col-lg-5 col-sm-5">
       <table>
           <th>
               Cuotas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           </th>
           <th class="text-right">
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valor
           </th>
           {{-- <th class="text-right">
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total
           </th> --}}
           <tr>
               <td class="text-center">3</td>
               <td class="text-right">{{number_format(($precio[1])/3, 2, '.', ',')}}</td>
              {{--  <td class="text-right">{{number_format(($precio[1]), 2, '.', ',')}}</td> --}}
           </tr>
           <tr>
               <td  class="text-center">6</td>
               <td class="text-right">{{number_format(($precio[1])/6, 2, '.', ',')}}</td>
              {{--  <td class="text-right">{{number_format(($precio[1]), 2, '.', ',')}}</td> --}}
           </tr>
           {{-- <tr>
               <td  class="text-center">9</td>    0.25     0.04
               <td class="text-right">{{number_format(($precio[1]*1.06)/9, 2, '.', ',')}}</td>
               <td class="text-right">{{number_format(($precio[1]*1.06), 2, '.', ',')}}</td>
           </tr>
           <tr>
               <td  class="text-center">12</td>
               <td class="text-right">{{number_format(($precio[1]*1.08)/12, 2, '.', ',')}}</td>
               <td class="text-right">{{number_format(($precio[1]*1.08), 2, '.', ',')}}</td>
           </tr> --}}
       </table>
   </div>
</div>
<br>
@endif