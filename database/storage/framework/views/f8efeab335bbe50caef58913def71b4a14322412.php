<div class="row form-group" ng-if="filtros">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <strong>Filtros</strong>
            </div>
            <div class="card-body">
                <form ng-submit="searchLeads()">
                    <div class="row form-group">
                        <div class="col-12 col-sm-4">
                            <label for="city">Ciudad</label>
                            <select id="city" class="form-control" ng-model="q.city" ng-options="city.value as city.label for city in cities"></select>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="typeService">Tipo de Servicio</label>
                            <select id="typeService" class="form-control" ng-model="q.typeService" ng-options="service.value as service.label for service in typeServices"></select>
                        </div>
                        <div class="col-12 col-sm-4">
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
    <div class="col-sm-12 col-md-4">
         <button class="btn btn-primary">
            <a ng-click="addCommunityForm()" >Agregar Lead <i class="far fa-plus-square"></i></a>
        </button>
    </div>
    <div class="col-sm-12 offset-md-3 col-md-4 text-right">
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
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Servicio</th>
                <th scope="col">Producto</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col">Campaña</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="lead in leads">
                <td>{{ lead.name }}</td>
                <td>{{ lead.lastName }}</td>
                <td>{{ lead.telephone }}</td>
                <td>{{ lead.city }}</td>
                <td>{{ lead.typeService }}</td>
                <td>{{ lead.typeProduct }}</td>
                <td>{{ lead.created_at }}</td>
                <td>{{ lead.campaignName }}</td>
                <td>
                    <i class="fas fa-edit cursor" title="Actualizar Lead" ng-click="showUpdateDialog(lead.id)"></i>
                    <i class="fas fa-times cursor" title="eliminar Lead" ng-click="showDialogDelete(lead.id)"></i>
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

<div class="row">
    <div class="col-6 text-right">
        <a href="/dashboard"><i class="fas fa-arrow-left"></i>  Dashboard</a>
    </div>
    <div class="col-6 text-left">
        <a href="/community"><i class="far fa-newspaper"></i> Gestión de Campañas</a>
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


<!--AddCommunityLead modal-->

<div class="modal fade" id="addCommunityLead" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Agregar Lead</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 form-group row">
                            <form ng-submit="addCommunityLeads()" id="addCommunityForm">
                                <?php echo e(csrf_field()); ?>



                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <label for="name">Nombre</label>
                                        <input type="text" ng-model="lead.name" id="name" cols="10" class="form-control" required>    
                                    </div>
                                     <div class="col-12 col-sm-6 no-padding-right">
                                        <label for="lastName">Apellido</label>
                                        <input type="text" ng-model="lead.lastName" id="lastName" cols="10" class="form-control" required>
                                    </div>                                   
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <label for="email">email</label>
                                        <input type="text" ng-model="lead.email" id="email" cols="10" class="form-control" required>                                       
                                    </div>
                                    <div class="col-12 col-sm-6 no-padding-right">
                                        <label for="telephone">telefono</label>
                                        <input type="text" ng-model="lead.telephone" id="telephone" cols="10" class="form-control" required>
                                    </div>
                                </div>


                                 <div class="form-group row">            
                                    <div class="col-12 col-sm-6">
                                        <label for="city">Ciudad</label>
                                         <select id="city" class="form-control" ng-model="lead.city">
                                             <option ng-repeat="city in cities" value="{{city.value}}">
                                                 {{city.value}}
                                             </option>
                                        </select>                                        
                                    </div>
                                    <div class="col-12 col-sm-6 no-padding-right">
                                        <label for="socialNetwork">Canal de adquisición</label>
                                        <select id="socialNetwork" class="form-control" ng-model="lead.channel">
                                            <option ng-repeat="socialNetwork in socialNetworks" value="{{socialNetwork.value}}">
                                                 {{socialNetwork.label}}
                                            </option>
                                        </select>                            

                                    </div>                               
                                </div>


                                 <div class="form-group row">            

                                    <label for="socialNetwork">Campaña</label>
                                     <select id="socialNetwork" class="form-control" ng-model="lead.campaign">
                                         <option ng-repeat="campaign in campaigns" value="{{campaign.name}}">
                                             {{campaign.name}}
                                         </option>
                                     </select>
                                </div>





                                <div class="form-group row">            
                                    <div class="col-12 col-sm-6">
                                        <label for="service">Servicio</label>
                                         <select id="service" class="form-control" ng-model="lead.typeService">
                                             <option ng-repeat="service in typeServices" value="{{service.value}}">
                                                 {{service.value}}
                                             </option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 no-padding-right">
                                        <label for="product">Producto</label>
                                        <input type="text" ng-model="lead.typeProduct" id="product" cols="10" class="form-control" required>
                                    </div>
                                </div>


                                <div class="form-group text-left">
                                    <button class="btn btn-primary">Agregar</button>
                                    <button class=" btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
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
<div class="modal fade" id="deleteCommunityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header text-center">
               <h4 class="modal-title" id="myModalLabel">Eliminar Lead</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 text-center">
                            <p>¿Estás seguro que deseas eliminar este registro?</p>
                        </div>
                        <div class="col-12">
                            <div class="row resetRow">
                                
                                <div class=" offset-4 col-4 form-group float-right">
                                    <form ng-submit="confirmDelete()">
                                        <div class="form-group text-right">
                                            <button class="btn btn-primary">Eliminar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-4 form-group float-right">
                                    <form ng-submit="cancelDelete()">
                                        <div class="form-group text-right">
                                            <button class="btn btn-danger">Cancelar</button>
                                        </div>
                                    </form>
                                </div>                            
                            </div>                            
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Update modal-->
<div class="modal fade" id="updateCommunityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Actualizar Lead</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 form-group">
                            <form ng-submit="updateCommunityLeads()">
                                <?php echo e(csrf_field()); ?>


                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <label for="name">Nombre</label>
                                        <input type="text" ng-model="lead.name" id="name" cols="10" class="form-control" value="{{ lead.name }}" required> 
                                    </div>
                                     <div class="col-12 col-sm-6 no-padding-right">
                                        <label for="lastName">Apellido</label>
                                        <input type="text" ng-model="lead.lastName" id="lastName" cols="10" class="form-control" value="{{lead.lastName}}" required>
                                    </div>                                   
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <label for="email">email</label>
                                        <input type="text" ng-model="lead.email" id="email" cols="10" class="form-control" value="{{lead.email}}" required>
                                    </div>
                                    <div class="col-12 col-sm-6 no-padding-right">
                                        <label for="telephone">telefono</label>
                                        <input type="text" ng-model="lead.telephone" id="telephone" cols="10" class="form-control" value="{{lead.telephone}}" required>
                                    </div>
                                </div>


                                 <div class="form-group row">            
                                    <div class="col-12 col-sm-6">
                                        <label for="city">Ciudad</label>
                                         <select id="city" class="form-control" ng-model="lead.city">
                                            <option ng-repeat="city in cities" value="{{city.value}}" label="{{city.label}}">
                                             {{city.value}}
                                            </option>
                                        </select>                                      
                                    </div>
                                    <div class="col-12 col-sm-6 no-padding-right">
                                        <label for="socialNetwork">Canal de adquisición</label>
                                        <select id="socialNetwork" class="form-control" ng-model="lead.socialNetwork">
                                         <option ng-repeat="socialNetwork in socialNetworks" value="{{socialNetwork.value}}" label="{{lead.socialNetwork}}">
                                             {{socialNetwork.label}}
                                         </option>
                                     </select>                       

                                    </div>                               
                                </div>

                                


                                 <div class="form-group row">
                                    <label for="socialNetwork">Campaña</label>
                                     <select id="socialNetwork" class="form-control" ng-model="lead.campaignName">
                                         <option ng-repeat="campaign in campaigns" value="{{campaign.name}}" label="{{lead.campaignName}}">
                                             {{campaign.name}}
                                         </option>
                                     </select>
                                </div>
                                <p>{{lead.campaignName}}</p>
                                <div class="form-group row">            
                                    <div class="col-12 col-sm-6">
                                        <label for="service">Servicio</label>
                                         <select id="service" class="form-control" ng-model="lead.typeService">
                                         <option ng-repeat="service in typeServices" value="{{service.value}}" label="{{service.label}}">
                                             {{service.value}}
                                         </option>
                                     </select>
                                    </div>
                                    <div class="col-12 col-sm-6 no-padding-right">
                                        <label for="product">Producto</label>
                                        <input type="text" ng-model="lead.typeProduct" id="product" cols="10" class="form-control" value="{{lead.typeProduct}}" required>
                                    </div>
                                </div>

                                <div class="form-group text-left">
                                    <button class="btn btn-primary">Agregar</button>
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