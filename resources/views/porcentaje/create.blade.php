<div id="formPorcentajeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar nueva porcentaje</h4>
            </div>
            <div class="modal-body">
                <span id="form_result_Porcentaje"></span>
                <form method="post" id="form_agregar_porcentaje" class="form-horizontal" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Porcentaje : </label>
                        <div class="col-md-8">
                            <input type="text" name="porcentaje" id="first_name" class="form-control" />
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
    $('#form_agregar_porcentaje').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'Agregar')
        console.log = "hola";
        {
            $.ajax({
            url:"{{route('porcentaje.storeAjax')}}",
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

                        $('#myTable3').prepend('<tr><td >'+data.porcentaje.idPorcentaje+'</td><td class="text-center">'
                        +data.porcentaje.porcentaje+'</td><td></td></tr>')
                        // console.log(data);
                        }    
                         $('#form_result_Porcentaje').html(html);                   
                }               
            }); 
        }
    });

</script>



