@extends('layouts.admin')
@section('title','Ingreso')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
@include('partial.error')
@php
use App\Expediente;
@endphp

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pa">
        <div class="panel panel-primary">
            @if (isset($expediente))
            <div class="panel-heading" style="font-size:150%; height: 40px;">Editar Ingreso</div>
            <div class="panel-body">
                {!!Form::model($expediente,['method'=>'PATCH','autocomplete'=>'off','route'=>['expediente.update',$expediente->id_expediente]])!!}
                @else
                {{-- <div class="panel-heading" style="font-size:150%; height: 40px;">Datos Ingreso</div> --}}
                <div class="panel-body">
                    {!!Form::open(array('url'=>'expediente','method'=>'POST','autocomplete'=>'off', 'id'=>'cliente_form'))!!}
                    @endif
                    {{Form::token()}}

                    <div class="row">
                        <p align="center" style="font-size: 40px;"><b> DATOS INGRESO </b> </p> 
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                               <div class="input-group"> 
                                   <label >Expediente</label>
                                    <input class="borde_ex" type="text" name="numero_expediente" value="{{isset($expediente->numero_expediente) ?  $expediente->numero_expediente : old('numero_expediente')}}"
                                        required />
                                </div> 
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                   <label>Habitación</label>
                                    <input type="text" name="habitacion"value="{{isset($expediente->habitacion) ?  $expediente->habitacion : old('habitacion')}}"
                                    class="borde_ex"  />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="a">F. Ingreso</label>
                                    <input type="text" readonly="readonly" name="fecha_hora_ex" id="fecha_hora_ex" value="{{isset($expediente->fecha_hora_ex) ?  $expediente->fecha_hora_ex : old('fecha_hora_ex')}}"
                                    class="borde_ex"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">DUI</label></b></div>
                                    <input type="text" {{--name="habitacion" value="isset($expediente->habitacion) ?  $expediente->habitacion : old('habitacion')--}}"
                                        class="form-control" placeholder="DUI..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">F. Nac. </label></b></div>
                                    <input type="text" readonly="readonly" {{--}} id="" name="" value="{{isset($expediente->) ?  $expediente-> : old('')}}"  --}}
                                        class="form-control"/>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Edad</label></b></div>
                                    <input type="text" readonly="readonly" name="edad" {{--value="{{isset($expediente->edad) ?  $expediente->edad : old('edad')}}"  --}}
                                        class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 pa">
                           
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"> <b><label class="a">Paciente </label></b></div>
                                    <input type="text" name="id_paciente" value="{{isset($expediente->id_paciente) ?  $expediente->id_paciente :old('id_paciente')}}"
                                    class="form-control" placeholder="Nombre paciente..." />
                                </div>
                            </div>
                        </div>   

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Tel.</label></b></div>
                                    <input type="text" {{-- name="tel_cliente" value="{{isset($expediente->tel_cliente) ?  $expediente->tel_cliente : old('tel_cliente')}}"  --}} 
                                        class="form-control" placeholder="Teléfono..."/>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Cel.</label></b></div>
                                    <input type="text" {{--name="tel_cliente2" value="{{isset($expediente->tel_cliente2) ?  $expediente->tel_cliente2 : old('tel_cliente2')}}"  --}}
                                        class="form-control"  placeholder="Celular..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"> <b><label class="a">Responsable</label></b></div>
                                    <input type="text" name="id_cliente" value="{{isset($expediente->id_cliente) ?  $expediente->id_cliente : old('id_cliente')}}"   {{--  name="id_cliente"
                                        value="{{isset($persona->id_cliente) ?  $persona->id_cliente :old('id_cliente')}}" --}}
                                        class="form-control" placeholder="Responsable..." />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Tel.</label></b></div>
                                    <input type="text" name="tel_cliente" value="{{isset($expediente->tel_cliente) ?  $expediente->tel_cliente : old('tel_cliente')}}"  
                                        class="form-control"  placeholder="Tel. casa..."/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Cel.</label></b></div>
                                    <input type="text" name="tel_cliente2" value="{{isset($expediente->tel_cliente2) ?  $expediente->tel_cliente2 : old('tel_cliente2')}}"  --}}
                                        class="form-control" placeholder="Tel. oficina..."/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p align="center" style="font-size: 20px;"><b> DATOS PARA ASEGURADORA </b> </p> 

                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                        <div class="input-group-addon bgd"><b><label class="a">Empresa</label></b></div>
                                        <input type="text" name="empresa" value="{{isset($expediente->empresa) ?  $expediente->empresa : old('empresa')}}"
                                        class="form-control" placeholder="Empresa..."/>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Asegurado</label></b></div>
                                    <input type="text" name="asegurado_principal" value="{{isset($expediente->asegurado_principal) ?  $expediente->asegurado_principal : old('asegurado_principal')}}"
                                        class="form-control" placeholder="Asegurado..."/>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                        <div class="input-group-addon bgd"><b><label class="a">Carnet n°</label></b></div>
                                        <input type="text" name="carnet" value="{{isset($expediente->carnet) ?  $expediente->carnet : old('carnet')}}"
                                        class="form-control" placeholder="carnet n°..."/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"> <b><label class="a">Dto.</label></b></div>
                                    <input type="text" name="dependecia"
                                        value="{{isset($expediente->dependecia) ?  $expediente->dependecia : old('dependecia')}}"
                                        class="form-control" placeholder="Dto o dependencia..." />
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                        <div class="input-group-addon bgd"><b><label class="a">Poliza n°</label></b></div>
                                        <input type="text" name="poliza" value="{{isset($expediente->poliza) ?  $expediente->poliza : old('poliza')}}"
                                        class="form-control" placeholder="poliza..."/>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"> <b><label class="a">Dx Ingeso</label></b></div>
                                    <input type="text" name="dx_ingreso"
                                        value="{{isset($expediente->dx_ingreso) ?  $expediente->dx_ingreso : old('dx_ingreso')}}"
                                        class="form-control" placeholder="DX de ingreso..." />
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                        <div class="input-group-addon bgd"><b><label class="a">Codigo n°</label></b></div>
                                        <input type="text" name="dx_codigo" value="{{isset($expediente->dx_codigo) ?  $expediente->dx_codigo : old('dx_codigo')}}"
                                        class="form-control" placeholder="Codigo n°..."/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Formulario</label></b></div>
                                    <input type="text" name="fomulario"
                                        value="{{isset($expediente->fomulario) ? $expediente->fomulario: old('fomulario')}}"
                                        class="form-control" placeholder="Formulario..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">C. No cub.</label></b></div>
                                    <input type="text" name="cargo_no_cub"
                                        value="{{isset($expediente->cargo_no_cub) ? $expediente->cargo_no_cub: old('cargo_no_cub')}}"
                                        class="form-control" placeholder="Cargos no cubiertos..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">T. Ingreso</label></b></div>
                                    <input type="text" name="tipo_ing"
                                        value="{{isset($expediente->tipo_ing) ? $expediente->tipo_ing: old('tipo_ing')}}"
                                        class="form-control" placeholder="Tipo de ingreso..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Ingreso por</label></b></div>
                                    <input type="text" name="ing_por"
                                        value="{{isset($expediente->ing_por) ? $expediente->ing_por: old('ing_por')}}"
                                        class="form-control" placeholder="Ingreso por..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Eventos ing.</label></b></div>
                                    <input type="text" name="even_ing"
                                        value="{{isset($expediente->even_ing) ? $expediente->even_ing: old('even_ing')}}"
                                        class="form-control" placeholder="Eventos de ingreso..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p align="center" style="font-size: 20px;"><b> DEJA RECIBO DE HONORARIOS EN CAJA </b> </p> 
                    
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Doctor</label></b></div>
                                    <input type="text" name="dr"
                                        value="{{isset($expediente->dr) ? $expediente->dr: old('dr')}}"
                                        class="form-control" placeholder="Doctor..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Doctor 2 </label></b></div>
                                    <input type="text" name="dr2"
                                        value="{{isset($expediente->dr2) ? $expediente->dr2: old('dr2')}}"
                                        class="form-control" placeholder="Doctor 2..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Doctor 3</label></b></div>
                                    <input type="text" name="dr3"
                                        value="{{isset($expediente->dr3) ? $expediente->dr3: old('dr3')}}"
                                        class="form-control" placeholder="Doctor 3..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Doctor 4</label></b></div>
                                    <input type="text" name="dr4"
                                        value="{{isset($expediente->dr4) ? $expediente->dr4: old('dr4')}}"
                                        class="form-control" placeholder="Doctor 4..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Doctor 5</label></b></div>
                                    <input type="text" name="dr5"
                                        value="{{isset($expediente->dr5) ? $expediente->dr5: old('dr5')}}"
                                        class="form-control" placeholder="Doctor 5..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Doctor 6</label></b></div>
                                    <input type="text" name="dr6"
                                        value="{{isset($expediente->dr6) ? $expediente->dr6: old('dr6')}}"
                                        class="form-control" placeholder="Doctor 6..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Doctor 7</label></b></div>
                                    <input type="text" name="dr7"
                                        value="{{isset($expediente->dr7) ? $expediente->dr7: old('dr7')}}"
                                        class="form-control" placeholder="Doctor 7..." />
                                </div>
                            </div>
                        </div>

                      

                      {{--   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Doctor</label></b></div>
                                    <input type="text" name="dr8"
                                        value="{{isset($expediente->dr8) ? $expediente->dr8: old('dr8')}}"
                                        class="form-control" placeholder="Doctor..." />
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    
                    <p align="center" style="font-size: 20px;"><b> DATOS PARA ASEGURADORA </b> </p> 


                    <div class="row">

                        <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">DX egreso</label></b></div>
                                    <input type="text" name="dx_egreso"
                                        value="{{isset($expediente->dx_egreso) ? $expediente->dx_egreso: old('dx_egreso')}}"
                                        class="form-control" placeholder="DX ppal egreso..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">F. Alta</label></b></div>
                                    <input type="text" name="fecha_hora_alta"  id="fecha_hora_alta" readonly="readonly"
                                        value="{{isset($expediente->fecha_hora_alta) ? $expediente->fecha_hora_alta: old('fecha_hora_alta')}}"
                                        class="form-control"/>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">O. Diagn.</label></b></div>
                                    <input type="text" name="otros_diag"
                                        value="{{isset($expediente->otros_diag) ? $expediente->otros_diag: old('otros_diag')}}"
                                        class="form-control" placeholder="Otros diagnosticos..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Interv.</label></b></div>
                                    <input type="text" name="inter_qui"
                                        value="{{isset($expediente->inter_qui) ? $expediente->inter_qui: old('inter_qui')}}"
                                        class="form-control" placeholder="Intervención quirurgica..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Cond Egre.</label></b></div>
                                        <select class="form-control" name="cond_egre" id="cond_egre">
                                            <option value="1"
                                                {{ isset($expediente->cond_egre) ? $expediente->cond_egre == '6' ? 'selected' : ""  : old('cond_egre') == "6" ? "selected" : ""}}>
                                                N/A</option>
                                            <option value="1"
                                                {{ isset($expediente->cond_egre) ? $expediente->cond_egre == '1' ? 'selected' : ""  : old('cond_egre') == "1" ? "selected" : ""}}>
                                                Curado</option>
                                            <option value="2"
                                                {{ isset($expediente->cond_egre) ? $expediente->cond_egre == '2' ? 'selected' : ""  : old('cond_egre') == "2" ? "selected" : ""}}>
                                                Mejorado</option>
                                            <option value="3"
                                                {{ isset($expediente->cond_egre) ? $expediente->cond_egre == '3' ? 'selected' : ""  : old('cond_egre') == "3" ? "selected" : ""}}>
                                                Igual</option>
                                            <option value="4"
                                                {{ isset($expediente->cond_egre) ? $expediente->cond_egre == '4' ? 'selected' : ""  : old('cond_egre') == "4" ? "selected" : ""}}>
                                                Pac. pide alta</option>
                                            <option value="5"
                                                {{ isset($expediente->cond_egre) ? $expediente->cond_egre == '5' ? 'selected' : ""  : old('cond_egre') == "5" ? "selected" : ""}}>
                                                Fallecido</option>
                                        </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Enf. resp.</label></b></div>
                                    <input type="text" name="enf_resp"
                                            value="{{isset($expediente->enf_resp) ? $expediente->enf_resp: old('enf_resp')}}"
                                        class="form-control" placeholder="Enfermera responsable..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">Observ.</label></b></div>
                                    <input type="text" name="obs_egre"
                                        value="{{isset($expediente->obs_egre) ? $expediente->obs_egre: old('obs_egre')}}"
                                        class="form-control" placeholder="Observaciones de egreso..." />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">H. Farm.</label></b></div>
                                    <input type="text" name="hora_far"
                                        value="{{isset($expediente->hora_far) ? $expediente->hora_far: old('hora_far')}}"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">H. Tel</label></b></div>
                                    <input type="text" name="hora_tel"
                                        value="{{isset($expediente->hora_tel) ? $expediente->hora_tel: old('hora_tel')}}"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">H. Caja</label></b></div>
                                    <input type="text" name="hora_caj"
                                        value="{{isset($expediente->hora_caj) ? $expediente->hora_caj: old('hora_caj')}}"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"><b><label class="a">R. Pagare</label></b></div>
                                    <input type="text" name="rec_paga"
                                        value="{{isset($expediente->rec_paga) ? $expediente->rec_paga: old('rec_paga')}}"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                  
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pa">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon bgd"> <b><label class="a">Estado</label></b></div>
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="Activo"
                                            {{ isset($expediente->estado) ? $expediente->estado == 'Activo' ? 'selected' : ""  : old('estado') == "Activo" ? "selected" : ""}}>
                                            Activo</option>
                                        <option value="Inactivo"
                                            {{ isset($expediente->estado) ? $expediente->estado == 'Inactivo' ? 'selected' : ""  : old('estado') == "Inactivo" ? "selected" : ""}}>
                                            Inactivo</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>


               

                    <!--fin-->
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12 pa">
                            @if (isset($persona))
                            <button class="btn btn-success btn-sm m-t-10" type="submit">ACTUALIZAR</button>
                            <a href="{{ url('/cliente') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a>

                            <button class="btn btn-warning btn-sm m-t-10" type="reset" align="right">RESET</button>
                            @else
                            <button class="btn btn-success btn-sm m-t-10" type="submit" id="btn">GUARDAR</button>
                            <a href="{{ url('/cliente') }}"><button class="btn btn-primary btn-sm m-t-10"
                                    type="button">CANCELAR</button></a>

                            <button class="btn btn-warning btn-sm m-t-10" type="reset" align="right">RESET</button>
                            @endif
                        </div>
                    </div>

                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

    <script>
         

    $(function () {
        var defaults = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: '', 
            changeMonth: true,
            changeYear: true
        };
        $.datepicker.setDefaults(defaults);
    
        $("#fecha_hora_ex").datepicker({});
        $("#fecha_hora_alta").datepicker({});
        
    });

     
</script>

    @endsection