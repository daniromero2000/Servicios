<div class="row form-group" ng-if="filtros">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <strong>Filtros</strong>
            </div>
            <div class="card-body">
                <form ng-submit="searchUsers()">
                    <div class="row form-group">
                         <div class="col-12 col-sm-6">
                            <label for="name">Nombre</label>
                            <input id="name" class="form-control" ng-model="q.q" >
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" ng-model="q.q" >
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="button" ng-click="resetFiltros()" class="btn btn-danger">Resetear Filtros <i class="fas fa-times"></i></button>
                            <button type="submit" class="btn btn-primary">Filtrar <i class="fas fa-filter"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row resetRow">
    <div class="col-sm-12 col-md-3">
         <button class="btn btn-primary">
            <a ng-click="addUserForm()" >Agregar Usuario <i class="far fa-plus-square"></i></a>
        </button>
    </div>

    <div class="col-sm-12 col-md-3">
         <button class="btn btn-primary">
            <a ng-click="addAssessorForm()" >Asignar perfil a asesor  <i class="fas fa-user-check"></i></a>
        </button>
    </div>

    <div class="col-sm-12 offset-md-1 col-md-4 text-right">
        <div class="input-group mb-3">
            <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
            <div class="input-group-append">
                <span class="input-group-text" id="searchIcon" ng-click="searchUsers()"><i class="fas fa-search"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-1 resetCol">
        <button type="button" ng-click="filtros=!filtros" class="btn btn-primary">Filtros <i class="fas fa-filter"></i></button>
    </div>
</div>
<div class="row">
    <span ng-if="errorFlag" class="w-100 alert alert-danger text-center" role="alert" ng-model="error">{{ error }}</span>
     <span ng-if="successFlag" class="w-100 alert alert-success text-center" role="alert" ng-model="error">{{ error }}</span>
</div>

<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th>Nombre de Usuario</th>
                <th>Email</th>
                <th>Tipo de Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="user in users">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.profileName }}</td>
                <td>                          
                    <i class="fas fa-edit cursor" title="Actualizar usuario" ng-click="updateUserForm(user.id)"></i>
                    <i class="fas fa-times cursor"  title="eliminar campaña" ng-click="deleteUserDialog(user.id)"></i>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getUsers()">Cargar Más</button>
        </div>
    </div>
</div>


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
                                <?php echo csrf_field(); ?>
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
                                        <select id="profile" type="text" class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" ng-model="assessor.profile" name="profile" required>
                                            <option ng-repeat="p in profiles" value="{{p.profileID}}">
                                                {{p.profileName}}
                                            </option>
                                        </select>          
                                        <?php if($errors->has('idProfile')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('idProfile')); ?></strong>
                                            </span>
                                        <?php endif; ?>
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
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 form-group">
                            <form ng-submit="addUser()" id="addForm">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de Usuario</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" ng-model="user.name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" ng-model="user.email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" ng-model="user.password" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
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

                                <select id="idProfile" type="text" class="form-controll<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" ng-model="user.idProfile" name="idProfile" required>
                                    <option ng-repeat="p in profiles" value="{{p.profileID}}">
                                        {{p.profileName}}
                                    </option>
                                </select>
                               

                                <?php if($errors->has('idProfile')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('idProfile')); ?></strong>
                                    </span>
                                <?php endif; ?>
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

<!--Delete modal-->

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

<!-- Update Modal-->

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
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de Usuario</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" ng-model="user.name" value="{{user.name}}" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" ng-model="user.email" value="{{ user.email }}" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Tipo de Usuario</label>

                            <div class="col-md-6">

                                <select id="idProfile" type="text" class="form-controll<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" ng-model="user.idProfile" name="idProfile" required>
                                    <option value="admin">Administrador</option>
                                    <option value="digital">Canal digital</option>
                                    <option value="community">Community</option>
                                    <option value="libranza">Libranza</option>
                                    <option value="fabrica">Fábrica de crédito</option>
                                    <option value="cruzado">Jefe de producto cruzado</option>
                                    <option value="marketing">Marketing</option>

                                </select>
                               

                                <?php if($errors->has('idProfile')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('idProfile')); ?></strong>
                                    </span>
                                <?php endif; ?>
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
  