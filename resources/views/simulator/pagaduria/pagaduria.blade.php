
<style>
    td{
        vertical-align: middle !important;
    }
</style>

<div class="row">
    <div class="col-8">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }" ng-click="tabs = 1" data-toggle="tab" role="tab" aria-controls="nav-general">PAGADURÍAS</a>
                <a class="nav-item nav-link cursor" id="nav-img-tab" ng-class="{ 'active': tabs == 2 }" ng-click="tabs = 2" data-toggle="tab" role="tab" aria-controls="nav-img">PERFILES</a>
            </div>
        </nav>
    </div>
    <div class="col-4 text-right">
        <button class="btn btn-primary">
            <a ng-click="addPagaduriaForm()" >Agregar Pagaduría <i class="far fa-plus-square"></i></a>
        </button>
    </div>
</div>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 1 }">
        <div class="table table-responsive">
        <form ng-submit="confirmUpdate()">
            <table class="table table-hover table-stripped leadTable">
                <thead class="headTableLeads">
                    <tr>
                        <th scope="col">Pagaduria</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <tr ng-repeat="pagaduria in pagadurias">
                <td>@{{ pagaduria.name }}</td>
                <td>                          
                    <i class="fas fa-edit cursor" title="Actualizar usuario" ng-click="showUpdate(pagaduria)"></i>
                    <i class="fas fa-times cursor"  title="eliminar pagaduria" ng-click="showDeleteModal(pagaduria.id)"></i>
                    <i class="fas fa-eye cursor"  title="Ver pagaduria" ng-click="viewPagaduria(pagaduria)"></i>
                </td>
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
                            <th scope="col">PERFIL</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="p in profiles">
                            <td>@{{p.name}}</td>
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

<div class="modal fade" id="viewPagaduria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Ver Pagaduría</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
               <div class="container">
               <div class="row form-group">
                        <div class="col-12">
                            <p><span class="labelViewLeadPagaduria">Nombre: </span><span class="textViewLead">  @{{ pagaduria.name }}</span></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Ciudad:</label>
                            <span class="textViewLead">@{{ pagaduria.city }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Dirección:</label>
                            <span class="textViewLead">@{{ pagaduria.address }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Telefono:</label>
                            <span class="textViewLead">@{{ pagaduria.numberPhone }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Oficina:</label>
                            <span class="textViewLead">@{{ pagaduria.offices }}</span>
                        </div>
                    </div>
                </div>
            </div>
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

<div class="modal fade" id="addPagaduria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Agregar Pagaduría</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 form-group">
                            <form ng-submit="addPagaduria()" id="addForm">
                            @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de Pagaduría</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" ng-model="pagaduria.name" value="pagaduria.name" required autofocus>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Dirección</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="address" ng-model="pagaduria.address" value="pagaduria.address" >

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Oficina</label>

                                    <div class="col-md-6">
                                        <input id="office" type="text" class="form-control" ng-model="pagaduria.office" name="office" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Telefono</label>
                                    <div class="col-md-6">
                                        <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" ng-model="pagaduria.phoneNumber" required>
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Ciudad</label>
                                    <div class="col-md-6">
                                    <select class="form-control" id="city" ng-model="pagaduria.city" ng-options="city.city as city.city for city in cities" ng-required="true"></select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Tipo de Usuario</label>
                                    <div class="col-md-6 multicomplete-pagaduria">  
                                        <multiple-autocomplete ng-model="pagaduria.profiles"
                                            suggestions-arr="profiles"
                                            object-property="name"
                                            >
                                        </multiple-autocomplete>
                                    </div>                                    
                                </div>
                                

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Crear Pagaduría
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


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Eliminar Pagaduría</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12">
                            <p>¿Está seguro que desea eliminar esta pagaduría?</p>
                        </div>
                        <div class="col-12 form-group">
                            <form ng-submit="deletePagaduria()">
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

<div class="modal fade" id="updatePagaduria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Actualizar Pagaduria</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 form-group">
                            <form ng-submit="updatePagaduria()" id="">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de Pagaduría</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" ng-model="pagaduria.name" value="@{{pagaduria.name}}" required autofocus>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Dirección</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="address" ng-model="pagaduria.address" value="@{{pagaduria.address}}" >

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Oficina</label>

                                    <div class="col-md-6">
                                        <input id="office" type="text" class="form-control" ng-model="pagaduria.office" name="office" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Telefono</label>
                                    <div class="col-md-6">
                                        <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" ng-model="pagaduria.phoneNumber" required>
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Ciudad</label>
                                    <div class="col-md-6">
                                    <select class="form-control" id="city" ng-model="pagaduria.city" ng-options="city.city as city.city for city in cities" ng-required="true"></select>
                                    </div>
                                </div>s
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Crear Pagaduría
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

  