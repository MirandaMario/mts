<div id="formCategoriaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar nueva resolucion</h4>
            </div>
            <div class="modal-body">
                <span id="form_result_resolucion"></span>
                <form method="post" id="form_agregar_resolucion" class="form-horizontal" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-2">T-Compro :</label>
                        <div class="col-md-4">
                            <select name="tipo_documento" class="form-control">
                                <option value="3">CCF</option>
                                <option value="2">Factura</option>
                                <option value="1">Ticket</option>
                            </select>
                        </div>
                        <label class="control-label col-md-2">Serie_res :</label>
                        <div class="col-md-4">
                            <input type="text" name="serie_resolucion"  class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Desde :</label>
                        <div class="col-md-4">
                            <input type="text" name="rango_desde"  class="form-control" />
                        </div>
                        <label class="control-label col-md-2">Hasta :</label>
                        <div class="col-md-4">
                            <input type="text" name="rango_hasta"  class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Num_res :</label>
                        <div class="col-md-4">
                            <input type="text" name="numero_resolucion"  class="form-control" />
                        </div>
                        <label class="control-label col-md-2">Fecha :</label>
                        <div class="col-md-4">
                            <input type="text" name="fecha_resolucion"  readonly id="check_in"  class="form-control" 
                            value="{{ date('Y-m-d')}}">
        
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Tienda_res:</label>
                        <div class="col-md-4">
                            <select name="tienda_res"  class="form-control">
                                @foreach($tiendas as $t)
                                <option value="{{$t->id}}"> {{$t->id}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="control-label col-md-2">Estado :</label>
                        <div class="col-md-4">
                            <select name="estado_res" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option> 
                            </select>
                        </div>
                    </div>
                    
                    <br/>
                    <div class="form-group" align="center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" id="btnt" class="btn btn-warning" value="Agregar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $('#form_agregar_resolucion').on('submit', function(event){
  event.preventDefault();
  $('#form_result_resolucion').html('<h4> GUARDANDO POR FAVOR ESPERE  ... </h4>  <img src="./../img/loader.gif" style="position: absolute;"/>');
   $.ajax({
    url:"{{route('resolucion.storeAjax')}}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
        {
            html = '<div class="alert alert-danger">';                             
                for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                html += '</div>';
        }
     if(data.success)
     {
      html = '<div class="alert alert-success">' + data.success + '</div>';
        //console.log(data);

        /* $('#idCategoria').empty();
         $.each(data.categorias, function(cat, obj){
            $('#idCategoria').append('<option value = "'+obj.idcategoria+'">'+obj.nombreCategoria+'</option>')
         }); */

     }
     $('#form_result_resolucion').html(html);
    }
   });
  
 });

</script>
