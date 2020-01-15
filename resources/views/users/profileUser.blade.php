@extends('layouts.admin.app')
@section('content')

<section class="content-header">


    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/analista1.png') }}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Usuario</b> <a class="float-right"
                                    style="font-size: 10pt;margin-top: 3px;">{{ $user->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Sucursal</b> <a class="float-right">{{ $user->codeOportudata }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="card">
                     <div class="card-body">
                        <div class="tab-content">

                            <div class="active tab-pane" id="activity">
                                <form id="form1" name="form1" class="form-horizontal"
                                    action="/Administrator/{{ $user->id }}/profile" method="post" class="form"
                                    enctype="multipart/form-data">

                                    @method('PUT')
                                    {{ csrf_field() }}
                                    <div class="form-group row justify-content-center">
                                        <label for="mypassword" class="col-sm-3 col-form-label">Contraseña
                                            Actual</label>
                                        <div class="col-sm-7 mt-2">
                                            <input type="password" class="form-control" name="mypassword"
                                                id="mypassword" placeholder="Contraseña Actual" required>
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <label for="password" class="col-sm-3 col-form-label">Nueva Contraseña</label>
                                        <div class="col-sm-7 mt-2">
                                            <input id="password" type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirmar
                                            Contraseña</label>
                                        <div class="col-sm-7 mt-2">
                                            <input id="password_confirmation" type="password" class="form-control"
                                                name="password_confirmation">


                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-sm-10">
                                            <button type="submit" onchange="validar_campos()"
                                                class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->

        </div>
        @include('layouts.errors-and-messages')

        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection