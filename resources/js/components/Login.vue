@extends('auth.contenido')

@section('login')

<template>
<div class="blog_post_image"></div>
    <div class="login-box">
      <div class="login-logo">
        <a href="index.html"><b>Softfede</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Inicio de Sesión</p>
        <form method="POST" action="{{ route('login') }}">
                        @csrf
          <div class="form-group has-feedback">
            <input type="usuario" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required autofocus  placeholder="Nombre de usuario">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('usuario'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('usuario') }}</strong>
                                    </span>
           @endif
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  name="password" required placeholder="Contrase&ntilde;a">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
             @endif
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    {{ __('Login') }}
              </button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->


</template>
@endsection

