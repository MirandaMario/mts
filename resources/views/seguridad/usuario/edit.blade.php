@extends('layouts.admin')
@section('title','Editar Usuario')
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
    <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 pa">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:150%; height: 40px;">
                Editar usuario
            </div>

            <div class="panel-body">
                {!!Form::model($usuario,['method'=>'PATCH','route'=>['usuario.update',$usuario->id], 'autocomplete' => 'off'])!!}
                {{Form::token()}}
                <div class="row">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label text-right">Name</label>

                        <div class="col-md-6 pa">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name }}">
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
           
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label text-right">E-Mail Address</label>

                        <div class="col-md-6 pa">
                            <input id="email" type="email" class="form-control " name="email"
                                value="{{ $usuario->email }}">
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label for="email" class="col-md-4 control-label text-right">ROL</label>
                        <div class="col-md-6 pa">
                            <input  type="text" class="form-control" name="rol" value="{{ $usuario->rol }}" required>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="col-md-4 control-label text-right">Tienda</label>
                        <div class="col-md-6 pa">
                            <input  type="text" class="form-control" name="tienda" value="{{ $usuario->id_tienda }}" required>
                        </div>
                    </div>
         
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label text-right">Password</label>

                        <div class="col-md-6 pa">
                            <input id="password" type="password" class="form-control" name="password">
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
         
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} text-right">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6 pa">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 pa ">
                        <button class="btn btn-success btn-sm m-t-10" type="submit">Actualizar</button>
                        <a href="{{ url('usuario') }}"><button class="btn btn-primary btn-sm m-t-10"
                                type="button">Cancelar</button></a>
                        <button class="btn btn-warning btn-sm m-t-10" type="reset" align="right">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection