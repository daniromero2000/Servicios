
<div class="card mb-4 border-0 shadow-lg">
    <div class="card-body">
        <div class="row form-group" ng-if="filtros">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Filtros</strong>
                    </div>
                    <div class="card-body">
                        <form ng-submit="searchCampaign()">
                            <div class="row form-group">
                                <div class="col-12 col-sm-4">
                                    <label for="name">Nombre</label>
                                    <input id="name" class="form-control" ng-model="q.q" >
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="socialNetwork">red social</label>
                                    <select id="socialNetwork" class="form-control" ng-model="q.socialNetwork" ng-options="socialNetwork.value as socialNetwork.label for socialNetwork in socialNetworks"></select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="budget">Presupuesto</label>
                                    <input name="budget" class="form-control" ng-model="q.budget">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-sm-6">
                                    <label for="beginDate">Fecha Inicial</label>
                                    <div class="input-group"
                                         moment-picker="q.beginDate"
                                         format="YYYY-MM-DD">
                                        <input class="form-control"
                                               ng-model="q.beginDate" id="beginDate">
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="endingDate">Fecha Final</label>
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
            <div class="col-sm-12 col-md-4">
                 <button class="btn btn-primary">
                    <a ng-click="addCampaignForm()" >Agregar Campaña <i class="far fa-plus-square"></i></a>
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
                        <th>Nombre de Campaña</th>
                        <th>Red Social</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Presupuesto</th>
                        <th>Presupuesto utilizado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="campaign in campaigns">
                        <td>@{{ campaign.name }}</td>
                        <td>@{{ campaign.socialNetwork }}</td>
                        <td>@{{ campaign.beginDate }}</td>
                        <td>@{{ campaign.endingDate }}</td>
                        <td>@{{ campaign.budget }}</td>
                        <td>@{{ campaign.usedBudget }}</td>
                        <td>
                            <i class="fa fa-eye" title="Ver detalles" ng-click="viewDetails(campaign.id)"></i>                           
                            <i class="fas fa-edit cursor" title="Actualizar campaña" ng-click="showUpdateDialog(campaign.id)"></i>
                            <i class="fas fa-times cursor" ng-if="campaign.remove == 0" title="eliminar campaña" ng-click="showDialog(campaign.id)"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        
        <div class="row">
            <div class="col-12 text-center">
                <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getCampaigns()">Cargar Más</button>
            </div>
        </div>
        
    </div>
</div>



<!-- view modal-->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">@{{campaign.name}}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="container">
                        <div class="row form-group">
                            <div class="col-sm-12 col-md-6">
                                <label class="labelViewLead">Nombre:</label>
                                <span class="textViewLead">@{{ campaign.name }}</span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label class="labelViewLead">Red Social:</label>
                                <span class="textViewLead">@{{ campaign.socialNetwork }}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12 col-md-6">
                                <label class="labelViewLead">Fecha de Inicio:</label>
                                <span class="textViewLead">@{{ campaign.beginDate }}</span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label class="labelViewLead">Fecha de Fin:</label>
                                <span class="textViewLead">@{{ campaign.endingDate }}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12 col-md-6">
                                <label class="labelViewLead">Presupuesto:</label>
                                <span class="textViewLead">@{{ campaign.budget }}</span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label class="labelViewLead">Presupuesto Usado:</label>
                                <span class="textViewLead">@{{ campaign.usedBudget }}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12 col-md-6">
                                <label class="labelViewLead">Descripción :</label>
                                <span class="textViewLead">@{{ campaign.description }}</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12 col-md-6">
                                <label class="labelViewLead">Imagen :</label>
                                <img src="/storage/@{{ campaign.imageName}}" alt="">
                            </div>
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
               <h4 class="modal-title" id="myModalLabel">@{{confirmDialog.title}}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12">
                            <p>@{{confirmDialog.message}}</p>
                        </div>
                        <div class="col-12 form-group">
                            <form ng-submit="confirmDelete()">
                                <div class="form-group text-left">
                                    <button class="btn btn-primary">@{{confirmDialog.label}}</button>
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

<!-- add campaign modal-->

<div class="modal fade" id="addCampaign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Agregar Campaña</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 form-group">
                            <form ng-submit="addCampaign()" id="addForm">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-12 no-padding-left">
                                        <label for="name">Nombre de campaña</label>
                                        <input type="text" ng-model="campaign.name" id="name" cols="10" class="form-control" required>
                                    </div>
                                   <!-- <div class="col-6 no-padding-right">
                                        <label for="socialNetwork">Red Social</label>
                                        <select id="socialNetwork" class="form-control" ng-model="campaign.socialNetwork">
                                         <option ng-repeat="socialNetwork in socialNetworks" value="@{{socialNetwork.value}}">
                                             @{{socialNetwork.value}}
                                         </option>
                                        </select>
                                    </div>  -->            
                                </div>
                               <!-- <div class="form-group row">
                                    <div class="col-6 no-padding-left">
                                        <label for="beginDate">Fecha de inicio</label>
                                        <div moment-picker="campaign.beginDate" format="YYYY-MM-DD" max-view="day" locale="en"  id="beginDate" cols="10" class="input-group"><input class="form-control" ng-model="campaign.beginDate" readonly></div>    
                                    </div>
                                    <div class="col-6 no-padding-right">
                                            <label for="endingDate">Fecha de fin</label>
                                            <div moment-picker="campaign.endingDate" format="YYYY-MM-DD" max-view="day" locale="en"  id="endingDate" cols="10" class="input-group"><input class="form-control" ng-model="campaign.endingDate" readonly></div>    
                                    </div>                                    
                                </div>                                

                                <div class="form-group row">
                                    <div class="col-6 no-padding-left">
                                        <label for="budget">Presupuesto</label>
                                        <input type="numero" ng-model="campaign.budget" id="budget" cols="10" class="form-control">                     
                                    </div>
                                    <div class="col-6 no-padding-right">
                                        <label for="budget">Presupuesto Gastado</label>
                                        <input type="numero" ng-model="campaign.usedBudget" id="usedBudget" cols="10" class="form-control">   
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description">Descripción</label>
                                    <textarea ng-model="campaign.description" id="description" cols="10" class="form-control" required></textarea>
                                </div>-->
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


<!--Update modal-->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">@{{confirmDialogUpdate.title}}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }" ng-click="tabs = 1" data-toggle="tab" role="tab" aria-controls="nav-general">General</a>
                            <a class="nav-item nav-link cursor" id="nav-img-tab" ng-class="{ 'active': tabs == 2 }" ng-click="tabs = 2" data-toggle="tab" role="tab" aria-controls="nav-img">Imágenes</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <!--form action="" ng-submit="saveChanges(campaign.id)">
                        {{ csrf_field() }}-->
                            <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 1 }">
                                <div class="row resetRow " >
                                    <div class="col-12 form-group">
                                       <form ng-submit="confirmUpdate()">
                                        
                                        <div class="form-group row">
                                            <div class="col-6 no-padding-left">
                                                <label for="name">@{{confirmDialogUpdate.labelName}}</label>
                                                <input type="text" ng-model="campaign.name" id="name" cols="10" value="@{{ campaign.name }}" class="form-control" required>
                                            </div>
                                            <div class="col-6 no-padding-right">
                                                <label for="name">@{{confirmDialogUpdate.labelSocialNetwork}}</label>
                                                <select id="socialNetwork" class="form-control" ng-model="campaign.socialNetwork">
                                                    <option ng-repeat="socialNetwork in socialNetworks" value="@{{socialNetwork.value}}" label="@{{socialNetwork.label}}">
                                                    @{{socialNetwork.value}}
                                                    </option>
                                                </select>                                       
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6 no-padding-left">
                                                <label for="name">@{{confirmDialogUpdate.labelBeginDate}}</label>
                                                <div moment-picker="campaign.beginDate" format="YYYY-MM-DD" max-view="day" locale="en"  id="beginDate" cols="10" class="input-group"><input class="form-control"
                                                ng-model="campaign.beginDate">
                                                </div>
                                            </div>
                                            <div class="col-6 no-padding-right">
                                                <label for="name">@{{confirmDialogUpdate.labelEndidgDate}}</label>
                                                <div moment-picker="campaign.endingDate" format="YYYY-MM-DD" max-view="day" locale="en"  id="endingDate" cols="10" class="input-group"><input class="form-control"
                                                ng-model="campaign.endingDate">
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6 no-padding-left">
                                                <label for="name">@{{confirmDialogUpdate.labelBudget}}</label>
                                                <input type="numero" ng-model="campaign.budget" id="budget" cols="10" class="form-control">
                                            </div>
                                            <div class="col-6 no-padding-right">
                                                <label for="name">@{{confirmDialogUpdate.labelUsedBudget}}</label>
                                                <input type="numero" ng-model="campaign.usedBudget" id="usedBudget" cols="10" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group  row">
                                            <label for="description">@{{confirmDialogUpdate.labelDescription}}</label>
                                            <textarea ng-model="campaign.description" id="description" cols="10" class="form-control" required></textarea>
                                        </div>
                                        
                                        <div class="form-group text-left">
                                            <button class="btn btn-primary">Actualizar</button>
                                        </div>
                                        </form>
                                    </div>
                                <hr>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-img" role="tabpanel" aria-labelledby="nav-img-tab" ng-class="{ 'show active': tabs == 2 }">
                                <div class="row">
                                    <ul ui-sortable="sortableOptions" ng-model="images" class="row ulImages">
                                        <li ng-repeat="image in images" class="gallery-box col-lg-3 col-md-4">
                                            <div class="imgContainer">
                                                <img class="imgCatalog" src="/storage/@{{image.name}}">
                                                <a class="closeProductsImages" ng-click="deleteImageModal(image.id)"><i class="fas fa-times"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <h4>Imagenes</h4>
                                <p>(solo se permite imágenes en formato jpg y jpeg preferiblemente de 200x200px y máximo 1MB)</p>
                                <form ng-submit="AddImages(campaign.id )">
                                    <input type="hidden" value="@{{campaign.id}}">
                                    <div flow-init
                                        flow-files-submitted="$flow.upload()"
                                        flow-file-added="!!{jpg:1,jepg:1}[$file.getExtension()]"
                                        flow-name="imgs.flow">
                                        <div class="row" flow-drop ng-class="dropClass">
                                            <div class="col-lg-4">
                                                <span class="btn  btn-outline-primary" flow-btn>Añadir imagen</span>
                                                <span class="btn  btn-outline-primary" flow-btn flow-directory ng-show="$flow.supportDirectory">Añadir carpeta</span>
                                            </div>
                                            <div class="col-md-12 col-lg-6 textImage">
                                                <span> <b>O</b>  Arrastra y suleta tus archivos aquí </span>
                                                <button type="submit" class="btn btn-outline-primary">Subir imagenes</button>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div ng-repeat="file in $flow.files" class="gallery-box col-lg-3 col-md-4">
                                            <span class="title">@{{file.name.substr(0,20)}}</span>
                                                <div class="flowContainer" ng-show="$flow.files.length">
                                                    <img flow-img="file"  class="imgCatalog"/>
                                                    <a class="closeProductsImages" ng-click="file.cancel()"><i class="fas fa-times"></i></a>
                                                </div>
                                                <div class="progress progress-bar-striped" ng-class="{active: file.isUploading()}">
                                                    <div class="progress-bar progress-bar-striped" role="progressbar"
                                                        aria-valuenow="@{{file.progress() * 100}}"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                        ng-style="{width: (file.progress() * 100) + '%'}">
                                                        <span class="sr-only">@{{file.progress()}}% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                       <!-- </form>-->                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
