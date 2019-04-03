<div class="row form-group" ng-if="filtros">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <strong>Filtros</strong>
            </div>
            <div class="card-body">
                <form ng-submit="searchLeads()">
                    <div class="row form-group">
                        <div class="col-12 col-sm-6">
                            <label for="city">Ciudad</label>
                            <select id="city" class="form-control" ng-model="q.city" ng-options="city.value as city.label for city in cities"></select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="state">Estado</label>
                            <select id="state" class="form-control" ng-model="q.state" ng-options="state.value as state.label for state in typeStates"></select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-sm-6">
                            <label for="fecha_ini">Fecha Inicial</label>
                            <div class="input-group"
                                 moment-picker="q.fecha_ini"
                                 format="YYYY-MM-DD">
                                <input class="form-control"
                                       ng-model="q.fecha_ini" id="fecha_ini">
                                <span class="input-group-addon">
                                    <i class="octicon octicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="fecha_fin">Fecha Final</label>
                            <div class="input-group"
                                 moment-picker="q.fecha_fin"
                                 format="YYYY-MM-DD">
                                <input class="form-control"
                                       ng-model="q.fecha_fin">
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
                <span class="input-group-text" id="searchIcon" ng-click="searchLeads()"><i class="fas fa-search"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-1 resetCol">
        <button type="button" ng-click="filtros=!filtros" class="btn btn-primary">Filtros <i class="fas fa-filter"></i></button>
    </div>
</div>
<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th scope="col">Estado</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Servicio</th>
                <th scope="col">Producto</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="lead in leads">
                <td scope="row">
                    <i class="far fa-bell" ng-if="lead.state==1" style="color: gray; font-size: 22px;" title="En estudio"></i>
                    <i class="fas fa-stopwatch" ng-if="lead.state==2" style="color: orange; font-size: 22px;" title="Es Espera"></i>
                    <i class="fas fa-clipboard-check" ng-if="lead.state==3" style="color: green; font-size: 22px;" title="Aprobado"></i>
                    <i class="fas fa-ban" ng-if="lead.state==4" style="color: red; font-size: 22px;" title="Negado"></i>
                </td>
                <td>{{ lead.name }}</td>
                <td>{{ lead.lastName }}</td>
                <td>{{ lead.telephone }}</td>
                <td>{{ lead.city }}</td>
                <td>{{ lead.typeService }}</td>
                <td>{{ lead.typeProduct }}</td>
                <td>{{ lead.created_at }}</td>
                <td>
                    <i class="fas fa-eye cursor" ng-if="lead.typeService == 'Credito libranza'" ng-click="vewLead(lead)"></i>
                    <i class="fas fa-comment cursor" ng-click="viewComments(lead.name, lead.lastName, lead.state, lead.id)"></i>
                    <br>
                    <i class="fas fa-check-double cursor"
                    ng-if="lead.state == 1 || lead.state == 2"
                    ng-click="changeStateLead(lead.name, lead.lastName, lead.id, 3, 'Aprobar solicitud')" 
                    title="Aprobar solicitud" ></i>

                    <i class="far fa-clock cursor" 
                    ng-if="lead.state == 1"
                    ng-click="changeStateLead(lead.name, lead.lastName, lead.id, 2, 'Poner solicitud en espera')" 
                    title="Poner solicitud en espera"></i>

                    <i class="fas fa-times cursor" 
                    ng-if="lead.state == 1 || lead.state == 2"
                    ng-click="changeStateLead(lead.name, lead.lastName, lead.id, 4, 'Negar Solicitud')" 
                    title="Negar Solicitud"></i>
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

<div class="modal fade" id="changeStateLead" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">{{ title }} - {{ nameLead + " " +lastNameLead }}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <form ng-submit="changeStateLeadComment()">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label for="comment">Comentario</label>
                            <textarea ng-model="comment.comment" id="comment" cols="10" class="form-control" required></textarea>
                        </div>
                        <div class="form-group text-left">
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
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
                            <span class="textViewLead">{{ lead.name }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Apellido:</label>
                            <span class="textViewLead">{{ lead.lastName }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Teléfono:</label>
                            <span class="textViewLead">{{ lead.telephone }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Correo Electrónico:</label>
                            <span class="textViewLead">{{ lead.email }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Ciudad:</label>
                            <span class="textViewLead">{{ lead.telephone }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Fecha registro:</label>
                            <span class="textViewLead">{{ lead.created_at }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Servicio:</label>
                            <span class="textViewLead">{{ lead.typeService }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Producto:</label>
                            <span class="textViewLead">{{ lead.typeProduct }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Edad:</label>
                            <span class="textViewLead">{{ lead.age }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Tipo de Cliente:</label>
                            <span class="textViewLead">{{ lead.customerType }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Pagaduría:</label>
                            <span class="textViewLead">{{ lead.pagaduria }}</span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Línea de Crédito:</label>
                            <span class="textViewLead">{{ lead.creditLine }}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6">
                            <label class="labelViewLead">Salario:</label>
                            <span class="textViewLead">${{ lead.salary | number:0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewComments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Ver Comentarios - {{ nameLead }} {{ lastNameLead }}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " ng-if="viewAddComent">
                        <div class="col-12 form-group">
                            <form ng-submit="addComment()">
                                <?php echo e(csrf_field()); ?>

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
                                <span class="nameAdminLead">{{ comment.name }}</span>
                            </div>
                            <div class="col-12">
                                <p class="commentUserLead">
                                    {{ comment.comment }}
                                </p>
                            </div>
                            <div class="col-12 text-right">
                                <span class="fechaUserLead">{{ comment.created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>