{!! Form::open(array('url'=>'seguridad/controldefactura','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<table class="table">
  <thead>
    <tr>
      <th scope="col"><input type="text"  style="width:200px;height:33px" name="searchText" placeholder='Fecha desde...' value="{{--$searchText--}}"/></th>
      <th scope="col"> <input type="text" style="width:200px;height:33px" name="searchText2" placeholder='Fecha hasta...' value="{{--$searchText--}}"/></th>
      <th style="width:200px"><select name="searchText3"   class="form-control">  
      					<option value="%">Cualquiera</option>
                        <option value="3">CCF</option>
                        <option value="2">Factura</option>
                        <option value="1">Ticket</option>
                    </select></th>
      <th scope="col"><button type="submit" class="btn btn-primary">
                Buscar
            </button></th>
    </tr>
  </thead>
  
</table>

{{Form::close()}}

