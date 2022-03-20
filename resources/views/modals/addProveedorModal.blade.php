<div id="formAddProveedorModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar nuevo proveedor</h4>
            </div>
            <div class="modal-body">
                <span id="form_result_cliente"></span>
                <form method="post" id="form_agregar_proveedor" class="form-horizontal" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-2">Nombre : </label>
                        <div class="col-md-10">
                            <input type="text" name="nombre" class="form-control" required
                                placeholder="Ingrese nombre proveedor ..." />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 factura">Alias : </label>
                        <div class="col-md-10">
                            <input type="text" name="alias" class="form-control" required
                                placeholder="Ingrese nombre comercial ..." />
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-warning" value="Agregar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>


<script>
    $('#form_agregar_proveedor').on('submit', function(event){
  event.preventDefault();
   $.ajax({
    url:"{{route('proveedor.storeAjax')}}",
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
     }
     $('#form_result_cliente').html(html);
    }
   });

 });

</script>
