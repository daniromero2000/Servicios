<style>
    td{
        vertical-align: middle !important;
    }
    .container{
        max-width: 1300px !important;
        margin: auto;
    }
</style>

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }" ng-click="tabs = 1" data-toggle="tab" role="tab" aria-controls="nav-general">General</a>
        <a class="nav-item nav-link cursor" id="nav-img-tab" ng-class="{ 'active': tabs == 2 }" ng-click="tabs = 2" data-toggle="tab" role="tab" aria-controls="nav-img">Facebook</a>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 1 }">
        <div class="row resetRow">
            <div class="col-sm-12 col-md-1">
                <p class="totalLeadsDigital text-center">
                    @{{ totalLeads }}
                </p>
                <p class="text-center">
                    Leads
                </p>
            </div>
            <div class="col-sm-12 offset-md-8 col-md-3 text-right">
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
                        <th scope="col">Cedula</th>
                        <th scope="col">Sucursal / N° solicitud</th>
                        <th scope="col">Asesor</th>
                        <th scope="col">Asesor OP</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Canal adquisición</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Cupo Producto/Avance</th>
                        <th scope="col" style="width: 10%;">Fecha registro</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="lead in leads">
                        <td>@{{ lead.CEDULA }}</td>
                        <td>@{{ lead.SUCURSAL }} - @{{ lead.SOLICITUD }}</td>
                        <td>@{{ lead.nameAsesor }}</td>
                        <td>@{{ lead.CODASESOR }}</td>
                        <td>@{{ lead.NOMBRES + " " + lead.APELLIDOS }}</td>
                        <td>@{{ lead.CELULAR }}</td>
                        <td>
                            <span ng-if="lead.channel == 1">Página Web</span>
                            <span ng-if="lead.channel == 2">Facebook</span>
                            <span ng-if="lead.channel == 3">WhatsApp</span>
                        </td>
                        <td>@{{ lead.CIUD_UBI }}</td>
                        <td>
                            $ @{{ lead.CUP_COMPRA | number:0 }} <br> / $ @{{ lead.CUPO_EFEC | number:0 }}
                        </td>
                        <td>@{{ lead.CREACION }}</td>
                        <td>
                            <i ng-if="lead.ASESOR_DIG != NULL" class="fas fa-comment cursor" ng-click="viewComments(lead.NOMBRES, lead.APELLIDOS, lead.state, lead.id)"></i>
                            <i ng-if="lead.ASESOR_DIG == NULL" class="fas fa-check cursor"  ng-click="assignAssesorDigitalToLead(lead.SOLICITUD)"></i>
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
        
        <div class="modal fade" id="viewComments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ver Comentarios - @{{ nameLead }} @{{ lastNameLead }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row resetRow " ng-if="viewAddComent">
                                <div class="col-12 form-group">
                                    <form ng-submit="addComment()">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="comment">Comentario</label>
                                            <textarea ng-model="comment.comment" id="comment" cols="10" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group text-left">
                                            <button class="btn btn-primary">Agregar</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                            </div>
                            <div class="row resetRow" ng-if="state != 4">
                                <div class="col-12 text-right form-group">
                                    <button type="button" ng-click="viewCommentChange()" class="btn btn-secondary"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="containerCommentsLeads">
                                <div ng-repeat="comment in comments" class="row resetRow form-group contianerCommentLead">
                                    <div class="col-12 text-left resetCol">
                                        <i class="fas fa-user iconoUserLead"></i>
                                        <span class="nameAdminLead">@{{ comment.name }}</span>
                                    </div>
                                    <div class="col-12">
                                        <p class="commentUserLead">
                                            @{{ comment.comment }}
                                        </p>
                                    </div>
                                    <div class="col-12 text-right">
                                        <span class="fechaUserLead">@{{ comment.created_at }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 2 }">
        <div class="row resetRow">
            <div class="col-sm-12 col-md-1">
                <p class="totalLeadsDigital text-center">
                    @{{ totalLeadsCM }}
                </p>
                <p class="text-center">
                    Leads
                </p>
            </div>
            <div class="col-sm-12 offset-md-8 col-md-3 text-right">
                <div class="input-group mb-3">
                    <input type="text" ng-model="q.qCM" class="form-control" aria-describedby="searchIcon">
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
                        <th scope="col">Estado</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Servicio</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="leadCM in leadsCM">
                        <td>
                            <i ng-if="leadCM.state == 1" class="fas fa-clock" title="Cliente en espera de procesar"></i>
                            <i style="color: green" ng-if="leadCM.state == 2" class="fas fa-check-double" title="Cliente procesado"></i>
                        </td>
                        <td>@{{ leadCM.identificationNumber }}</td>
                        <td>@{{ leadCM.name + " " + leadCM.lastName }}</td>
                        <td>@{{ leadCM.email }}</td>
                        <td>@{{ leadCM.telephone }}</td>
                        <td>@{{ leadCM.city }}</td>
                        <td>@{{ leadCM.typeService }}</td>
                        <td>@{{ leadCM.created_at }}</td>
                        <td>
                            <i ng-if="leadCM.state == 1" class="fas fa-check cursor" title="Marcar cliente como procesado" ng-click="checkLeadProcess(leadCM.id)"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-secondary" ng-disabled="cargandoCM" ng-click="getLeads()">Cargar Más</button>
                </div>
            </div>
        </div>
    </div>
</div>
