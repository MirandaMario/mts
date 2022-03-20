<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Busqueda </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-inline my-2 my-lg-0 " action="./busqueda" method="GET" autocomplete="off">
                <div class="input-group">
                  <input type="text" class="form-control resizedTextbox" placeholder="...buscar" name="str" id="findheadermovil"   aria-label="buscar"
                    aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-outline-" type="SUBMIT" {{-- id="button-addon2" --}}> <b> <i class="ti-search"
                          style="color: black; font-size: 25px;"></i></b> </button>
                  </div>
                 
                  <div>
                    
            
                    </div>
                    <table  id="ListaProductosHeadermodal" class="table table-striped  table-hover table-sm"   WIDTH="90%" {{--  --}}>
            
                    </table>
                  <div id="gitarticuloheadermovil"></div>
               
                  
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

