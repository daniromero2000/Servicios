<div class="row">
    <div class="col-sm-12 offset-md-8 col-md-4 text-right">
        <div class="input-group mb-3">
            <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
            <div class="input-group-append">
                <span class="input-group-text" id="searchIcon" ng-click="searchLeads()"><i class="fas fa-search"></i></span>
            </div>
        </div>
    </div>
</div>
<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th>Servicio</th>
                <th>Producto</th>
                <th>Fecha de registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="lead in leads">
                <td>@{{ lead.name }}</td>
                <td>@{{ lead.lastName }}</td>
                <td>@{{ lead.telephone }}</td>
                <td>@{{ lead.city }}</td>
                <td>@{{ lead.typeService }}</td>
                <td>@{{ lead.typeProduct }}</td>
                <td>@{{ lead.created_at }}</td>
                <td>
                    <i class="fas fa-eye cursor" ng-if="lead.typeService == 'Credito libranza'" ng-click="vewLead(lead)"></i>
                    <i class="far fa-eye-slash" ng-if="lead.typeService != 'Credito libranza'"></i>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getLeads()">Cargar Más</button>
        </div>
    </div>
</div>

<div class="modal fade" id="viewLead" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Ver Contacto</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
               <div class="container">
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Nombre:</label>
                            <span class="textViewLead">@{{ lead.name }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Apellido:</label>
                            <span class="textViewLead">@{{ lead.lastName }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Teléfono:</label>
                            <span class="textViewLead">@{{ lead.telephone }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Correo Electrónico:</label>
                            <span class="textViewLead">@{{ lead.email }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Ciudad:</label>
                            <span class="textViewLead">@{{ lead.telephone }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Fecha registro:</label>
                            <span class="textViewLead">@{{ lead.created_at }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Servicio:</label>
                            <span class="textViewLead">@{{ lead.typeService }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Producto:</label>
                            <span class="textViewLead">@{{ lead.typeProduct }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Edad:</label>
                            <span class="textViewLead">@{{ lead.age }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Tipo de Cliente:</label>
                            <span class="textViewLead">@{{ lead.customerType }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Pagaduría:</label>
                            <span class="textViewLead">@{{ lead.pagaduria }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Línea de Crédito:</label>
                            <span class="textViewLead">@{{ lead.creditLine }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Salario:</label>
                            <span class="textViewLead">$@{{ lead.salary | number:0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>