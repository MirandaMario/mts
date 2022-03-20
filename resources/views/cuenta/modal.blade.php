<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$cu->id}}">
    {{Form::Open(array('action'=>array('CuentasController@destroy',$cu->id),'method'=>'delete'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">DAR DE BAJA A CUENTA</h4>
            </div>
            <div class="modal-body">
                <p>CONFIRME SI DESEA CANCELAR EL REGISTRO: <b> {{$cu->banco}} {{$cu->numeroCuenta}} </b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-danger">
                    Confirmar
                </button>
            </div>
        </div>
    </div>
    {{Form::Close()}}
</div>

