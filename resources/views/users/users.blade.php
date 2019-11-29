<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card  shadow-lg ">

                <div class="card-header bg-white">
                    <div class="row resetRow">
                        <div class="col-sm-12 col-md-3 mb-1">
                            <button class="btn btn-primary" ng-click="addUserForm()">
                                <a>Agregar Usuario <i class="far fa-plus-square"></i></a>
                            </button>
                        </div>

                        <div class="col-sm-12 col-md-3 mb-1">
                            <button class="btn btn-primary">
                                <a ng-click="addAssessorForm()">Asignar perfil a asesor <i
                                        class="fas fa-user-check"></i></a>
                            </button>
                        </div>

                        <div class="col-sm-12 offset-md-3 col-md-3 text-right">
                            <div class="input-group mb-3">
                                <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="searchIcon" ng-click="searchUsers()"><i
                                            class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span ng-if="errorFlag" class="w-100 alert alert-danger text-center" role="alert"
                            ng-model="error">@{{ error }}</span>
                        <span ng-if="successFlag" class="w-100 alert alert-success text-center" role="alert"
                            ng-model="error">@{{ error }}</span>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body ">
                    <table id="example2" class="table  table-stripped leadTable  table-hover">
                        <thead class=" text-center">
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Tipo de Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="user in users">
                                <td>@{{ user.name }}</td>
                                <td>@{{ user.email }}</td>
                                <td>@{{ user.profileName }}</td>
                                <td>
                                    <i class="fas fa-edit cursor" title="Actualizar usuario"
                                        ng-click="updateUserForm(user)"></i>
                                    <i class="fas fa-times cursor" title="eliminar campaña"
                                        ng-click="deleteUserDialog(user.id)"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getUsers()">Cargar
                                Más</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</section>

<!-- Assessor modal -->

<div class="modal fade" id="assessorAddProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Asignar perfil a usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row resetRow">
                        <div class="col-12 form-group">
                            <form ng-submit="addAssessorProfile()" id="addProfileAssessor">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">
                                        Codigo de Asesor
                                    </label>
                                    <div class="col-md-6">
                                        <angucomplete-alt id="ex1" placeholder="Buscar códdigo" pause="100"
                                            selected-object="selectedCode" local-data="assessors" search-fields="CODIGO"
                                            title-field="CODIGO" description-field='NOMBRE' minlength="1"
                                            input-class="form-control form-control-small" input-name="code" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Tipo de
                                        Usuario</label>
                                    <div class="col-md-6">
                                        <select id="profile" type="text"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            ng-model="assessor.profile" required>
                                            <option ng-repeat="p in profiles" value="@{{p.profileID}}">
                                                @{{p.profileName}}
                                            </option>
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
                                        <button type="submit" class="btn btn-primary">
                                            Asignar perfil
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add user modal -->

<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row resetRow ">
                        <div class="col-12 form-group">
                            <form ng-submit="addUser()" id="addForm">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="name">Nombre</label>
                                        <input id="name" type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            ng-model="user.name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="email">Usuario</label>
                                        <input id="email" type="text"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            ng-model="user.email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="password">Contraseña</label>
                                        <input id="password" type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            ng-model="user.password" required>
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="password-confirm">Confirmar contraseñas</label>
                                        <input id="password-confirm" type="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="password">Tipo de Usuario</label>
                                        <select id="idProfile" type="text"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            ng-model="user.idProfile" required
                                            ng-options="p.profileID as p.profileName for p in profiles">
                                        </select>
                                        @if ($errors->has('idProfile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('idProfile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="checkbox" ng-model="viewCodeAsesorOportudata" ng-value-true="true"
                                        ng-value-false="false" id="viewCodeAsesorOportudata"> <label
                                        for="viewCodeAsesorOportudata" style="font-size:15px; line-height:2">Usuario de
                                        canal digital</label>
                                </div>
                                <div class="row form-group" ng-show="viewCodeAsesorOportudata">
                                    <div class="col-12 col-sm-6">
                                        <label for="ex2">
                                            Buscar Asesor
                                        </label>
                                        <div>
                                            <angucomplete-alt id="ex2" placeholder="Buscar códdigo" pause="100"
                                                selected-object="selectedCodeOportudata" local-data="assessors"
                                                search-fields="CODIGO" title-field="CODIGO" description-field='NOMBRE'
                                                minlength="1" input-class="form-control form-control-small"
                                                input-name="code" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label for="">Codigo Oportudata</label>
                                        <input type="text" class="form-control" ng-disabled="true"
                                            ng-model="user.codeOportudata" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            Crear Usuario
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Delete modal-->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row resetRow ">
                        <div class="col-12">
                            <p>¿Está seguro que desea eliminar este usuario?</p>
                        </div>
                        <div class="col-12 form-group">
                            <form ng-submit="deleteUser()">
                                <input type="hidden" name="_method" value="DELETE" />
                                <div class="form-group text-left">
                                    <button class="btn btn-primary">Eliminar</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Modal-->

<div class="modal fade" id="updateUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row resetRow">
                        <div class="col-12 form-group">
                            <form ng-submit="updateUser()" id="updForm">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="nameUpd">Nombre de Usuario</label>
                                        <input id="nameUpd" type="text"
                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            ng-model="userUpd.name" required autofocus>
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="emailUpd">Correo Electronico</label>
                                        <input id="emailUpd" type="text"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            ng-model="userUpd.email" required>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="idProfileUpd">Tipo de Usuario</label>
                                        <select id="idProfileUpd" type="text"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            ng-model="userUpd.idProfile" required
                                            ng-options="p.profileID as p.profileName for p in profiles">
                                        </select>
                                        @if ($errors->has('idProfile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('idProfile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row" ng-show="viewCodeAsesorOportudataInput">
                                    <div class="col-12 col-sm-6">
                                        <label for="">Código Oportudata</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox"
                                                        aria-label="Checkbox for following text input"
                                                        ng-model="viewCodeAsesorOportudataUpd" ng-value-true="true"
                                                        ng-value-false="false">
                                                </div>
                                            </div>
                                            <input type="text" ng-model="userUpd.codeOportudata" class="form-control"
                                                aria-label="Text input with checkbox" ng-disabled="true" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6" ng-show="viewCodeAsesorOportudataUpd">
                                        <label for="ex3">
                                            Buscar Asesor
                                        </label>
                                        <div>
                                            <angucomplete-alt id="ex3" placeholder="Buscar códdigo" pause="100"
                                                selected-object="selectedCodeOportudataUpd" local-data="assessors"
                                                search-fields="CODIGO" title-field="CODIGO" description-field='NOMBRE'
                                                minlength="1" input-class="form-control form-control-small"
                                                input-name="code" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            Actualizar Usuario
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>