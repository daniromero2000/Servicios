<div class="row form-group" ng-if="filtros">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <strong>Filtros</strong>
            </div>
            <div class="card-body">
                <form ng-submit="searchCustomer()">
                <div class="row form-group">
                         <div class="col-12 col-sm-6">
                            <label for="solic">Número Solicitud</label>
                            <input id="solic" class="form-control" ng-model="q.solic" >
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="cliente">Cédula</label>
                            <input id="cliente" class="form-control" ng-model="q.q" >
                        </div>                          
                    </div>      
                    <div class="row form-group">
                         <div class="col-12 col-sm-6">
                            <label for="name">Nombres</label>
                            <input id="name" class="form-control" ng-model="q.q" >
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="email">Apellidos</label>
                            <input id="email" class="form-control" ng-model="q.q" >
                        </div>
                    </div>
                    <div class="row form-group">
                         <div class="col-12 col-sm-6">
                            <label for="state">Estados</label>
                            <input id="state" class="form-control" ng-model="q.state" >
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="fechaSol">Fecha </label>
                            <div class="input-group"
                                 moment-picker="q.fechasol"
                                 format="YYYY-MM-DD">
                                <input class="form-control"
                                       ng-model="q.fechasol">
                                <span class="input-group-addon">
                                    <i class="octicon octicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                         <div class="col-12 col-sm-6">
                            <label for="firstDate">Fecha inicio</label>
                            <div class="input-group"
                                 moment-picker="q.firstDate"
                                 format="YYYY-MM-DD">
                                <input class="form-control"
                                       ng-model="q.firstDate">
                                <span class="input-group-addon">
                                    <i class="octicon octicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="lastDate">Fecha Fin</label>
                            <div class="input-group"
                                 moment-picker="q.endingDate"
                                 format="YYYY-MM-DD">
                                <input class="form-control"
                                       ng-model="q.endingDate">
                                <span class="input-group-addon">
                                    <i class="octicon octicon-calendar"></i>
                                </span>
                            </div>
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
    <div class="col-sm-12 offset-md-7 col-md-4 text-right">
        <div class="input-group mb-3">
            <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
            <div class="input-group-append">
                <span class="input-group-text" id="searchIcon" ng-click="searchCustomer()"><i class="fas fa-search"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-1 resetCol">
        <button type="button" ng-click="filtros=!filtros" class="btn btn-primary">Filtros <i class="fas fa-filter"></i></button>
    </div>
</div>
<div class="row">
    <span ng-if="errorFlag" class="w-100 alert alert-danger text-center" role="alert" ng-model="error">@{{ error }}</span>
     <span ng-if="successFlag" class="w-100 alert alert-success text-center" role="alert" ng-model="error">@{{ error }}</span>
</div>

<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th>Solicitud</th>
                <th>Nombre de Cliente</th>
                <th>Cédula</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="customer in customers">
                <td>@{{ customer.SOLICITUD }}</td>
                <td>@{{ customer.NOMBRES }} @{{ customer.APELLIDOS }}</td>
                <td>@{{ customer.CLIENTE }}</td>
                <td>                          
                    <i class="fas fa-eye cursor" title="Actualizar usuario" ng-click="viewDetails(customer.SOLICITUD)"></i>
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


<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">SOLICITUD @{{customer.SOLICITUD}} -  @{{customer.ESTADO}}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">NOMBRES:</label>
                            <span class="textViewLead">@{{ customer.NOMBRES }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">APELLIDOS:</label>
                            <span class="textViewLead">@{{ customer.APELLIDOS }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">FECHA DE SOLICITUD:</label>
                            <span class="textViewLead">@{{ customer.FECHASOL }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">CÉDULA:</label>
                            <span class="textViewLead">@{{ customer.CLIENTE }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">CODEUDOR 1:</label>
                            <span class="textViewLead">@{{ customer.CODEUDOR1 }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">CODEUDOR 2:</label>
                            <span class="textViewLead">@{{ customer.CODEUDOR2 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  