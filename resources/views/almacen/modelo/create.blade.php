<div id="formModeloModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar nueva modelo</h4>
            </div>
            <div class="modal-body">
                <span id="form_result_modelo"></span>
                <form method="post" id="form_agregar_modelo" class="form-horizontal" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf


                    <div class="form-group">
                        <label class="control-label col-md-4">Marca : </label>
                        <div class="col-md-8">
                            <select name="idMarca" id="idMarca" class="form-control">
                                @foreach($marcas as $mar)
                                <option value="{{$mar->idMarca}}">
                                    {{$mar->nombreMarca}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Modelo : </label>
                        <div class="col-md-8">
                            <input type="text" name="nombreModelo"  class="form-control" />
                        </div>
                    </div>


                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="actionModelo"  value="Agregar"  />
                       {{--  <input type="hidden" name="hidden_id" id="hidden_id" /> --}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                        <input type="submit" name="action_button" id="action_button_modelo" class="btn btn-warning"
                            value="Agregar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $('#form_agregar_modelo').on('submit', function(event){
  event.preventDefault();

  if($('#actionModelo').val() == 'Agregar')
  $('#form_result_modelo').html('<h4>GUARDANDO POR FAVOR ESPERE  ...</h4>  <img src="./../img/loader.gif" style="position: absolute;"/>');
  {
   $.ajax({
    url:"{{route('modelo.storeAjax')}}",
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
       // console.log(data);
    /*
        $('#idMarca').empty();
         $.each(data.marcas, function(mar, obj){
            $('#idMarca').append('<option value = "'+obj.idMarca+'">'+obj.nombre+'</option>')
         });
         */
     }
     $('#form_result_modelo').html(html);
    }
   });
  }

 });

</script>
