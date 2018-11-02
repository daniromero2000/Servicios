@extends('layouts.app')
 
@section('content')
    <h2> Crear Nuevo Usuario </h2>
    <hr>
 
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('users.update',$user->id) }}">
        <input type="hidden" name="_method" value="PUT">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de Usuario</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}"  autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    

                         <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Tipo de Usuario</label>

                            <div class="col-md-6">

                                <select id="idProfile" type="text" class="form-controll{{ $errors->has('password') ? ' is-invalid' : '' }}" name="idProfile" >
                                    <option value="admin">Administrador</option>
                                    <option value="digital">Canal digital</option>
                                    <option value="community">community</option>
                                </select>
                               

                                @if ($errors->has('idProfile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('idProfile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                                 <button type="submit" class="btn btn-primary">Actualizar usuario</button>
                                
                            </div>
                        </div>
                    </form>
 
@stop