<div id="formCategoriaModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar nueva categoría</h4>
            </div>
            <div class="modal-body">
                <span id="form_result_Categoria"></span>
                <form method="post" id="form_agregar_categoria" class="form-horizontal" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Categoría : </label>
                        <div class="col-md-8">
                            <input type="text" name="nombreCategoria" id="first_name" class="form-control" />
                        </div>
                    </div>


                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                            value="Agregar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $('#form_agregar_categoria').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Agregar')
  console.log = "hola";
  {
   $.ajax({
    url:"{{route('categoria.storeAjax')}}",
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
        console.log(data);

        $('#idCategoria').empty();
         $.each(data.categorias, function(cat, obj){
            $('#idCategoria').append('<option value = "'+obj.idcategoria+'">'+obj.nombreCategoria+'</option>')
         });

     }
     $('#form_result_Categoria').html(html);
    }
   });
  }

 });

</script>
