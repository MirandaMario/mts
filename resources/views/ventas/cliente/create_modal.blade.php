<style>
    #mdialTamanio{
      width: 70% !important;
    }
  </style>
<div id="form_cliente_create_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" id="mdialTamanio">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar nuevo cliente</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="form_agregar_cliente" class="form-horizontal" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-2">Nombre : </label>
                        <div class="col-md-10">
                            <input type="text" name="nombre"  class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Direccion : </label>
                        <div class="col-md-10">
                            <input type="text" name="direccion"  class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Telefono : </label>
                        <div class="col-md-4">
                            <input type="text" name="tel"  class="form-control" />
                        </div>
                       
                        
                        <label class="control-label col-md-2">Municipio : </label>
                        <div class="col-md-4">
                            <input type="text" id="nombre_municipio"  class="form-control"  value="San Salvador" />
                            <input type="hidden" name="municipio"  id="municipio"  value="214" />
                            <div id="gitmunicipios"></div>
                            <div id="ListaMunicipios" name="ListaMunicipios"></div> 
                        </div>
                        
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">NIT : </label>
                        <div class="col-md-4">
                            <input type="text" name="nit"  class="form-control" />
                        </div>
                        <label class="control-label col-md-2">NCR : </label>
                        <div class="col-md-4">
                            <input type="text" name="iva"  class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">DUI : </label>
                        <div class="col-md-4">
                            <input type="text" name="dui"  class="form-control" />
                        </div>
                        <label class="control-label col-md-2">E-MAIL : </label>
                        <div class="col-md-4">
                            <input type="text" name="email"  class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Giro : </label>
                        <div class="col-md-10">
                            <input type="text" name="giro"  class="form-control" />
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                        <input type="submit" name="action_button" id="action_button2" class="btn btn-warning"
                            value="Agregar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script>
    $('#form_agregar_cliente').on('submit', function(event){
  event.preventDefault();
/*   if($('#action_button').val() == 'Agregar')

  { */
    $('#form_result').html('<h4>GUARDANDO POR FAVOR ESPERE  ...</h4>  <img src="./../img/loader.gif" style="position: absolute;"/>');
   $.ajax({
    url:"{{route('cliente.storeAjax')}}",
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
    
       /*  $('#marcas').empty();
         $.each(data.marcas, function(mar, obj){
            $('#marcas').append('<option value = "'+obj.idMarca+'">'+obj.nombreMarca+'</option>')
         }); */
        
     }
     $('#form_result').html(html);
    }
   });
  /* } */

 });

</script>
