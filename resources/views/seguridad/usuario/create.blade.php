@extends('layouts.admin')
@section('title','Nuevo Usuario')
@section('contenido')
<link rel="stylesheet" href="{{asset('css/estilo.css')}}">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
              @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

    <div class="row" style="{{ config('constantes.FONT') }}">
        <div class="col-md-9 pa">
            <div class="panel panel-primary">
                <div class="panel-heading" style="font-size:150%; height: 40px;" >
                     Ingresar nuevo usuario 
                </div>

                    <div class="panel-body" >
                         {!!Form::open(array('url'=>'usuario','method'=>'POST','autocomplete'=>'off'))!!}
                         {{Form::token()}}

                        <div class="row">
                            <div class="col-md-2 pa">
                                <div  class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="apa">Name</label>
                                </div>
                            </div>    
                        
                            <div class="col-md-10 pa">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                     @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
       
                        <div class="row">
                            <div class="col-md-2 pa">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="apa">E-Mail</label>
                                </div>
                            </div>

                            <div class="col-md-10 pa">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                     @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 pa">
                                <div class="form-group">
                                    <label class="apa">ROL</label>
                                </div>
                            </div>

                            <div class="col-md-10 pa">
                                <input name="rol" type="number" class="form-control" required >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 pa">
                                <div class="form-group">
                                    <label class="apa">Tienda</label>
                                </div>
                            </div>

                            <div class="col-md-10 pa">
                                <input name="id_tienda" type="number" class="form-control" required >
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-2 pa">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="apa">Password</label>
                                </div>
                            </div>

                            <div class="col-md-10 pa">
                                <input id="password" type="password" class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-md-2 pa">
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm" class="apa">Confirm Password</label>
                                </div>
                            </div>
                            
                            <div class="col-md-10 pa">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
<br>
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
                                <button class="btn btn-success btn-sm m-t-10" type="submit">Guardar</button>
                                <a href="{{ url('usuario') }}"><button class="btn btn-primary btn-sm m-t-10"   type="button">Cancelar</button></a>
                                <button class="btn btn-warning btn-sm m-t-10" type="reset"  align="right">Reset</button> 
                            </div>   
                        </div>
                    </div>
                </div> 
            </div>
    </div>      

      
        {!!Form::close()!!}

@stop