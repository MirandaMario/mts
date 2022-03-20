<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
    id="modal-delete-{{$zo->id_miscelanea}}">
    {{Form::Open(array('action'=>array('ConfiguracionController@update', $zo->id_miscelanea),'method'=>'put', 'autocomplete' => 'off'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">Editar Configuración {{$zo->id_miscelanea}}</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="control-label col-md-4">Moneda : </label>
                    <div class="col-md-8">
                        <input type="number" step="0.0001" name="moneda" class="form-control" value="{{$zo->moneda}}" />
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="control-label col-md-4">Cadena : </label>
                    <div class="col-md-8">
                        <textarea name="cadena" class="form-control"  > {{$zo->cadena}} </textarea>
                    </div>
                </div>
                <br><br><br>
                <div class="form-group">
                    <label class="control-label col-md-4">Descripción : </label>
                    <div class="col-md-8">
                        <input type="text" name="descripcion" class="form-control" value="{{$zo->descripcion}}"  readonly/>
                    </div>
                </div>
            </div>
            <br>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-danger">
                    Actualizar
                </button>
            </div>

        </div>
    </div>
    {{Form::Close()}}
</div>