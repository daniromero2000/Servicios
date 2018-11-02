@extends('layouts.app')
 
@section('content')
 <div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> {{$user->name}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Regresar </a>
            </div>
        </div>
    </div>
 
 
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email</strong>
                {{ $user->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipo de Usuario</strong>
                @if($user->idProfile==1)
                    <span>Administrador</span>
                @elseif($user->idProfile==2)
                    <span>Líder Canal Dígital</span>
                @else
                    <span>Community Manager</span>
                @endif
            </div>
        </div>
        
    </div>
 </div>
@stop