@include('modals.addMarcaModal')
@include('modals.addCategoriaModal')

<div id="formArticuloModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar nuevo artículo</h4>
            </div>
            <div class="modal-body">
                <span id="form_result_Articulo"></span>
                <form method="post" id="form_agregar_articulo" class="form-horizontal" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Código: </label>
                        <div class="col-md-8">
                            <input type="text" name="codigo" id="codigo" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Nombre: </label>
                        <div class="col-md-8">
                            <input type="text" name="nombre" id="nombre" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Marca: &nbsp;&nbsp;&nbsp;&nbsp; <a href=""
                                data-target="#formMarcaModal" data-dismiss="modal" data-toggle="modal">

                                <span class="fa fa-plus-square" aria-hidden="true">
                                </span>
                            </a></label>
                        <div class="col-md-8">
                            <input type="text" name="marca" id="marca" class="form-control" required />

                            <input type="hidden" name="idMarca" id="idMarca" class="form-control" />
                            <div id="ListaMarcas">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Categoría: &nbsp;&nbsp;&nbsp;&nbsp; <a href=""
                                data-target="#formCategoriaModal" data-dismiss="modal" data-toggle="modal">

                                <span class="fa fa-plus-square" aria-hidden="true">
                                </span>
                            </a> </label>
                   {{--      <div class="col-md-8">
                            <select name="idcategoria" id="idCategoria" class="form-control">
                                @foreach($categorias as $cat)
                                <option value="{{$cat->idcategoria}}">
                                    {{$cat->idcategoria}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cat->nombreCategoria}}
                                </option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-2">Stock: </label>
                        <div class="col-md-4">
                            <input type="number" name="stock" id="stock" class="form-control" value="1" step="1"
                                required />
                        </div>

                        <label class="control-label col-md-2">Precio venta: </label>
                        <div class="col-md-4">
                            <input type="number" name="precio" id="precio" class="form-control" step="0.01" value="0.00"
                                required />
                        </div>
                    </div>

                    <br />
                    <div class="form-group  text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="btncerrar">Cerrar</button>
                        <input type="submit" class="btn btn-warning" value="Agregar" />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="reset" class="btn btn-info ">Reset</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
{{-- <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script> --}}
<script>
    $('#form_agregar_articulo').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Agregar')
  console.log = "hola";
  {
   $.ajax({
    url:"{{route('articulo.storeAjax')}}",
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
    /*
        $('#idMarca').empty();
         $.each(data.marcas, function(mar, obj){
            $('#idMarca').append('<option value = "'+obj.idMarca+'">'+obj.nombre+'</option>')
         });
         */
     }
     $('#form_result_Articulo').html(html);
    }
   });
  }

 });

</script>



<script>
    $(document).ready(function(){

     $('#marca').keyup(function(){
            var query = $(this).val();
            if(query != '')
            {
             var _token = $('input[name="_token"]').val();
             $.ajax({
              url:"{{ route('marca.fetchAjax') }}",
              method:"POST",
              data:{query:query, _token: _token},
              success:function(data){
               $('#ListaMarcas').fadeIn();
                        $('#ListaMarcas').html(data);
              }
             });
            }
        });

        $('#ListaMarcas').on('click', 'li', function(){
            $('#marca').val($(this).text());
            $('#ListaMarcas').fadeOut();


             var datosMarca = $(this).text().split('      ');
            $('#idMarca').val(datosMarca[0]);
        });


          $('#btncerrar').on('click', function(){
            $('#form_agregar_articulo').trigger("reset");

        });



    });

</script>
