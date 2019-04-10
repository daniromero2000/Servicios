
<style>
    td{
        vertical-align: middle !important;
    }
</style>

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }" ng-click="tabs = 1" data-toggle="tab" role="tab" aria-controls="nav-general">PARÁMETROS</a>
        <a class="nav-item nav-link cursor" id="nav-img-tab" ng-class="{ 'active': tabs == 2 }" ng-click="tabs = 2" data-toggle="tab" role="tab" aria-controls="nav-img">PLAZOS</a>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 1 }">
        <div class="table table-responsive">
        <form ng-submit="confirmUpdate()">
            <table class="table table-hover table-stripped leadTable">
                <thead class="headTableLeads">
                    <tr>
                        <th scope="col">Parametro</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TASA</td>
                        <td>
                        <input class="form-control text-center" type="" value="@{{ params[0].rate}}" ng-model="params[0].rate">
                        </td>
                    </tr>
                    <tr>
                        <td>DESFASE</td>
                        <td><input class="form-control text-center" type="" value="@{{ params[0].rate}}" ng-model="params[0].gap"></td>
                    </tr>
                    <tr>
                        <td>SEGURO
                            <br>
                            (18 - 70 años)
                        </td>
                        <td><input class="form-control text-center" type="" value="@{{ params[0].rate}}" ng-model="params[0].assurance"></td>
                    </tr>
                    <tr>
                        <td>SEGURO
                        <br>
                            (71 - 89 años)
                        </td>
                        <td><input class="form-control text-center" type="" value="@{{ params[0].rate}}" ng-model="params[0].assurance2"></td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4 text-center">
                    <button type="submit" class="btn btn-primary">
                        Actualizar
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 2 }">
        <div class="table table-responsive">
            <form ng-submit="addTimeLimit()">
                <table class="table table-hover table-stripped leadTable">
                    <thead class="headTableLeads">
                        <tr>
                            <th scope="col">PLAZO</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="p in plazos">
                            <td>@{{p.timeLimit}}</td>
                            <td>
                                <button class="btn btn-danger" ng-click="deleteTimeLimit(p.id)">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control text-center" value="" ng-model="plazo.timeLimit">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">
                                    Agregar
                                </button>
                            </td>
                        </tr>                        
                    </tbody>
                </table>                    
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Actualizar parámetros</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12">
                            <p>¿Está seguro que desea Actualizar los parámetros del simulador?</p>
                        </div>
                        <div class="col-6 form-group">
                            <form ng-submit="updateSimulator()">
                                <input type="hidden" name="_method" value="DELETE" />
                                <div class="form-group text-right">
                                    <button class="btn btn-primary">Confirmar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6 form-group">                            
                            <div class="form-group text-left">
                                <button class="btn btn-danger" ng-click="getParams()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancelar</button>
                            </div>                        
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Assessor modal -->
<!--
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
                                        <angucomplete-alt id="ex1"
                                      placeholder="Buscar códdigo"
                                      pause="100"
                                      selected-object="selectedCode"
                                      local-data="assessors"
                                      search-fields="CODIGO"
                                      title-field="CODIGO"
                                      description-field='NOMBRE'
                                      minlength="1"
                                      input-class="form-control form-control-small"
                                      input-name="code"/>
                                        
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Tipo de Usuario</label>
                                    <div class="col-md-6">
                                        <select id="profile" type="text" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" ng-model="assessor.profile" name="profile" required>
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
-->

<!-- Add user modal -->
<!--
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 form-group">
                            <form ng-submit="addUser()" id="addForm">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de Usuario</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" ng-model="user.name" value="{{ old('name') }}" required autofocus>

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
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" ng-model="user.email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" ng-model="user.password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseñas</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Tipo de Usuario</label>

                            <div class="col-md-6">

                                <select id="idProfile" type="text" class="form-controll{{ $errors->has('password') ? ' is-invalid' : '' }}" ng-model="user.idProfile" name="idProfile" required>
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
                                    Crear Usuario
                                </button>
                            </div>
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
-->
<!--Delete modal-->
<!---
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Eliminar Usuario</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
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
-->
<!-- Update Modal-->
<!--
<div class="modal fade" id="updateUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 form-group">
                            <form ng-submit="updateUser()" id="addForm">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de Usuario</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" ng-model="user.name" value="@{{user.name}}" required autofocus>

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
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" ng-model="user.email" value="@{{ user.email }}" required>

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

                                <select id="idProfile" type="text" class="form-controll{{ $errors->has('password') ? ' is-invalid' : '' }}" ng-model="user.idProfile" name="idProfile" required>
                                    <option value="admin">Administrador</option>
                                    <option value="digital">Canal digital</option>
                                    <option value="community">Community</option>
                                    <option value="libranza">Libranza</option>
                                    <option value="fabrica">Fábrica de crédito</option>
                                    <option value="cruzado">Jefe de producto cruzado</option>
                                    <option value="marketing">Marketing</option>

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
                                    Crear Usuario
                                </button>
                            </div>
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
-->
  