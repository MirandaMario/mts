<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$cat->idcategoria}}">
        {{Form::Open(array('action'=>array('CategoriaController@update',$cat->idcategoria),'method'=>'PATCH','autocomplete="off"'))}}
     
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <h4 class="modal-title">Editar categoría</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-4">Nombre : </label>
                            <div class="col-md-8">
                                <input type="text" name="nombreCategoria" class="form-control"  value="{{$cat->nombreCategoria}}"/>
                            </div>
                        </div> 
                        <br><br>
                        <div class="form-group">
                            <label class="control-label col-md-4">Descuento : </label>
                            <div class="col-md-8">
                                <input type="number" name="descuento_cat" class="form-control" step="0.01" value="{{$cat->descuento_cat}}"/>
                                *descuento debe ser ingresado en numeros enteros
                            </div>
                        </div>                          
                </div>
                <br>
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
    
    