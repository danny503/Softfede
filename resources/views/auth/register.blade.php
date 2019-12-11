@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('fechnac') ? ' has-error' : '' }}">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                                     <div class="col-md-9">
                                        <input type="date" value="{{ old('fechanac') }}" class="form-control" placeholder="Fecha nacimiento">                                        
                                        
                                @if ($errors->has('fechanac'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fechanac') }}</strong>
                                    </span>
                                @endif
                                    </div>
                        </div>
                                <div class="form-group row {{ $errors->has('genero') ? ' has-error' : '' }}">
                                    <label class="col-md-3 form-control-label" for="text-input">Genero</label>
                                    <div class="col-md-9">
                                        <select class="form-control " value="{{ old('genero') }}">
                                            <option value="" disabled>Seleccione su genero</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Maculino</option>
                                        </select>
                                        
                                @if ($errors->has('genero'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('genero') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('direccion') ? ' has-error' : '' }}">
                                    <label class="col-md-3 form-control-label" >Dirección</label>
                                    <div class="col-md-9">
                                        <input type="text" value="{{ old('direccion') }}" class="form-control" placeholder="Dirección">
                                        
                                @if ($errors->has('direccion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('telefono') ? ' has-error' : '' }}">
                                    <label class="col-md-3 form-control-label" for="email-input">Teléfono</label>
                                    <div class="col-md-9">
                                        <input type="text" value="{{ old('telefono') }}" class="form-control" data-inputmask="'mask': ['9999-9999 []', '+099 99 99 9999[9]-9999']" data-mask>
                                        @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>                               
                                <div class="form-group row {{ $errors->has('rol') ? ' has-error' : '' }}">
                                    <label class="col-md-3 form-control-label" for="email-input">Rol</label>
                                    <div class="col-md-9">
                                        <select class="form-control" value="{{ old('rol') }}">
                                            <option value="0" disabled>Seleccione un rol</option>                                            
                                            </option>
                                            @if ($errors->has('rol'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rol') }}</strong>
                                    </span>
                                @endif
                                        </select>
                                    </div>
                            </div>  

                                 <div class="form-group {{ $errors->has('usuario') ? ' has-error' : '' }}">
                            <label for="usuario" class="col-md-4 control-label">USusario</label>

                            <div class="col-md-6">
                                <input id="usuario" type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" required autofocus>

                                @if ($errors->has('usuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                                  
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
