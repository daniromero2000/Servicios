@extends('layouts.app')

@section('content')
<div class="container containerLogin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header row">
                	<div class="col-6 loginText">
                		<p> {{ __('Asesores') }} </p>	
                	</div>
                	<div class="col-6 loginLogo">
                		<img src="{{ asset('images/logoDashboard.png')}}">
                	</div>
                	
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('assessors.access') }}" id="loginForm">
                        @csrf

                        <div class="form-group row">
                            <label for="codigo" class="col-sm-4 col-form-label text-md-right">{{ __('Código') }}</label>

                            <div class="col-md-6">
                                <input id="codigo" type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" value="{{ old('codigo') }}" required autofocus>

                                @if ($errors->has('codigo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('codigo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="num_doc" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="num_doc" type="num_doc" class="form-control{{ $errors->has('num_doc') ? ' is-invalid' : '' }}" name="num_doc" required>

                                @if ($errors->has('num_doc'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('num_doc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar sesión') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('assessors.password.request') }}">
                                    {{ __('¿ Olvidaste tu contraseña ?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
