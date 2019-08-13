<!--<div class="row form-group" ng-if="filtros">
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
</div>-->
<div class="row resetRow">
    <div class="col-12 col-md-3">
        <a href="" ng-click="openModalAddMoto()" class="btn btn-primary">Agregar Moto <i class="fas fa-plus"></i></a>
    </div>
    <div class="col-sm-12 offset-md-4 col-md-4 text-right">
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
                <th scope="col">Marca</th>
                <th scope="col">Detalles</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="moto in motos">
                <td>@{{ moto.name }}</td>
                <td>@{{ moto.brandMoto }}</td>
                <td>@{{ moto.details }}</td>
                <td>
                    <i class="fas fa-eye cursor" ng-click="viewMoto(moto)"></i>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="more()">Cargar Más</button>
        </div>
    </div>
</div>

<div class="modal fade" id="changeStateLead" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">@{{ title }} - @{{ nameLead + " " +lastNameLead }}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <form ng-submit="changeStateLeadComment()">
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
            </div>
        </div>
    </div>
</div>


<div class="modal fade hide" id="viewMoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
    <div class="modal-motos modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel1">Ver Información</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="closeModal()"><span aria-hidden="true">×</span></button>
               <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="closeModal()"><span aria-hidden="true">×</span></button>-->
           </div>
           <div class="modal-body">
               <div class="container">
                   <div class="row">
                        <div class="col-3">
                            <div class="nav nav-tabs flex-column nav-pills nav-pills-motos" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" ng-class="{ 'active': tabs == 1 }" ng-click="tabs = 1" id="v-pills-info-tab" data-toggle="pill"  role="tab" aria-controls="v-pills-info" aria-selected="true"> 
                                    <i class="fas fa-info-circle"></i> Información General
                                </a>
                                <a class="nav-link" ng-class="{ 'active': tabs == 2 }" ng-click="tabs = 2" id="v-pills-ficha-tab" data-toggle="pill"  role="tab" aria-controls="v-pills-ficha" aria-selected="true"> 
                                    <i class="fas fa-tachometer-alt"></i> Ficha técnica
                                </a>
                                <a class="nav-link" ng-class="{ 'active': tabs == 3 }" ng-click="tabs = 3" id="v-pills-precios-tab" data-toggle="pill"  role="tab" aria-controls="v-pills-precios" aria-selected="true"> 
                                    <i class="fas fa-money-check-alt"></i> Precios
                                </a>
                                <a class="nav-link" ng-class="{ 'active': tabs == 4 }" ng-click="tabs = 4" id="v-pills-imagenes-tab" data-toggle="pill"  role="tab" aria-controls="v-pills-imagenes" aria-selected="true"> 
                                    <i class="fas fa-images"></i> Imagenes
                                </a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show" ng-class="{ 'show active': tabs == 1 }"   role="tabpanel" aria-labelledby="v-pills-info-tab">
                                    <div class="row fix-width">
                                          <h3>INFORMACIÓN GENERAL <i class="fas fa-info-circle"></i></h3>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-4">
                                                <p>Marca</p>
                                            </div>
                                            <div class="col-4">
                                                <p>Modelo</p>
                                            </div>
                                            <div class="col-4">
                                                <p>Detalles</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-4">
                                                <span>@{{moto.brandMoto}}</span>
                                            </div>
                                            <div class="col-4">
                                                <span>@{{moto.name}}</span> 
                                            </div>
                                            <div class="col-4">
                                                <span>@{{moto.details}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-12">
                                                <p>Imagen descripción</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-12">
                                                <img src="/images/motos/@{{moto.imageDescription}}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-12">
                                               <p>Descripción</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-12">
                                                <span>@{{moto.description}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" ng-class="{ 'show active': tabs == 2 }"  role="tabpanel" aria-labelledby="v-pills-ficha-tab">
                                    <div class="row fix-width">
                                        <h3><i class="fas fa-tachometer-alt"></i>  FICHA TÉCNICA</h3>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-12">
                                                <h4>Motor</h4>
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-4">
                                                  <p>Tipo</p>
                                            </div>
                                            <div class="col-4">
                                                  <p>Desplazamiento</p>
                                            </div>
                                            <div class="col-4">
                                                  <p>Máx. potencia</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-4">
                                                  <span>@{{moto.engine}}</span>
                                            </div>
                                            <div class="col-4">
                                                  <span>@{{moto.displacement}}</span>
                                            </div>
                                            <div class="col-4">
                                                  <span>@{{moto.power}}</span>
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-6">
                                                  <p>Max. Torque</p>
                                            </div>
                                            <div class="col-6">
                                                  <p>Arranque</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-6">
                                                  <span>@{{moto.torque}}</span>
                                            </div>
                                            <div class="col-6">
                                                  <span>@{{moto.start}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-12">
                                                <h4>Transmisión</h4>
                                            </div>    
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-6">
                                                  <p>Sistema de encendido</p>
                                            </div>
                                            <div class="col-6">
                                                  <p>Relación de Compresión</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-6">
                                                  <span>@{{moto.ignition}}</span>
                                            </div>
                                            <div class="col-6">
                                                  <span>@{{moto.compression}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-12">
                                                <h4>Suspensión</h4>
                                            </div>    
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-6">
                                                  <p>Suspensión delantera</p>
                                            </div>
                                            <div class="col-6">
                                                  <p>Suspensión trasera</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-6">
                                                  <span>@{{moto.frontSuspension}}</span>
                                            </div>
                                            <div class="col-6">
                                                  <span>@{{moto.backSuspension}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-12">
                                                <h4>Llantas</h4>
                                            </div>    
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-6">
                                                  <p>Llanta delantera</p>
                                            </div>
                                            <div class="col-6">
                                                  <p>llanta trasera</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-6">
                                                  <span>@{{moto.tireFront}}</span>
                                            </div>
                                            <div class="col-6">
                                                  <span>@{{moto.tireBack}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-12">
                                                <h4>Frenos</h4>
                                            </div>    
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-6">
                                                  <p>Freno delantero</p>
                                            </div>
                                            <div class="col-6">
                                                  <p>Freno trasero</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-6">
                                                  <span>@{{moto.frontBrake}}</span>
                                            </div>
                                            <div class="col-6">
                                                  <span>@{{moto.rearBrake}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-12">
                                                <h4>Dimensiones</h4>
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-4">
                                                  <p>Largo total</p>
                                            </div>
                                            <div class="col-4">
                                                  <p>Altura Total</p>
                                            </div>
                                            <div class="col-4">
                                                  <p>Ancho total</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-4">
                                                  <span>@{{moto.long}}</span>
                                            </div>
                                            <div class="col-4">
                                                  <span>@{{moto.height}}</span>
                                            </div>
                                            <div class="col-4">
                                                  <span>@{{moto.width}}</span>
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-4">
                                                  <p>Distancia entre ejes</p>
                                            </div>
                                            <div class="col-4">
                                                  <p>Altura al sillín</p>
                                            </div>
                                            <div class="col-4">
                                                  <p>Peso neto</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-4">
                                                  <span>@{{moto.axisDistance}}</span>
                                            </div>
                                            <div class="col-4">
                                                  <span>@{{moto.seatHeight}}</span>
                                            </div>
                                            <div class="col-4">
                                                  <span>@{{moto.weight}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" ng-class="{ 'show active': tabs == 3 }"  role="tabpanel" aria-labelledby="v-pills-precios-tab">
                                    <div class="row fix-width">
                                           <h3><i class="fas fa-money-check-alt"></i> PRECIOS</h3>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="col-6">
                                                <p>Precio Contado:</p>
                                            </div>
                                            <div class="col-6">
                                                <p>Precio Lista crédito:</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-6">
                                                <span>@{{moto.price}}</span>
                                            </div>
                                            <div class="col-6">
                                                <span>@{{moto.creditPrice}}</span>
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-6">
                                                <p>AVAL:</p>
                                            </div>
                                            <div class="col-6">
                                                <p>SOAT:</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-6">
                                                <span>@{{moto.aval}}</span>
                                            </div>
                                            <div class="col-6">
                                                <span>@{{moto.soat}}</span>
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-6">
                                                <p>Bonos marca:</p>
                                            </div>
                                            <div class="col-6">
                                                <p>Matrícula, pignoración y tramitador:</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width row-shadow">
                                            <div class="col-6">
                                                <span>@{{moto.brandBonus}}</span>
                                            </div>
                                            <div class="col-6">
                                                <span>@{{moto.creditEnrollment  }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" ng-class="{ 'show active': tabs == 4 }"  role="tabpanel" aria-labelledby="v-pills-imagenes-tab">
                                    <div class="row fix-width">
                                        <h3><i class="fas fa-images"></i> IMAGENES</h3>
                                    </div>
                                    <div class="colInfo">
                                        <div class="row fix-width">
                                            <div class="offset-2 col-8 text-center">
                                               <p>Imagen principal</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="offset-3 col-6">
                                                <img src="/images/motos/@{{moto.image}}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="offset-2 col-8 text-center">
                                                <p>Imagenes de detalles</p>
                                            </div>
                                        </div>
                                        <div class="row fix-width">
                                            <div class="col-3" ng-repeat="imageMoto in motoImages">
                                                <div class="card">
                                                    <img src="/images/motos/motos-vistas/@{{imageMoto.image}}" alt="" class="card-img-top">
                                                    <div class="card-body">
                                                        <p class="card-text">@{{imageMoto.image}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade hide" id="addMotoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
    <div class="modal-motos modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Agregar Moto</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="closeModal()"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form ng-submit="addMoto()">
                        <div class="row">
                            <div class="col-6">
                                <label for="motoBrand">Marca</label>
                            </div>
                            <div class="col-6">
                                <label for="motoModel">Modelo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <select id="motoBrand" type="text" class="form-control" ng-model="moto.idBrand" required ng-options="b.id as b.brand for b in brands"></select>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" ng-model="moto.name" >
                            </div>
                        </div>
                        <div class="row resetRow">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btnStep">Continuar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade hide" id="addMoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
    <div class="modal-motos modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel1">Agregar Moto</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="closeModal()"><span aria-hidden="true">×</span></button>
               <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="closeModal()"><span aria-hidden="true">×</span></button>-->
           </div>
           <div class="modal-body">
               <div class="container">
                    <form ng-submit="updateMoto()">
                        <div class="row">
                            <div class="col-3">
                                <div class="nav nav-tabs flex-column nav-pills nav-pills-motos" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" ng-class="{ 'active': tabs == 1 }" ng-click="tabs = 1" id="v-pills-info-tab" data-toggle="pill"  role="tab" aria-controls="v-pills-info" aria-selected="true"> 
                                        <i class="fas fa-info-circle"></i> Información General
                                    </a>
                                    <a class="nav-link" ng-class="{ 'active': tabs == 2 }" ng-click="tabs = 2" id="v-pills-ficha-tab" data-toggle="pill"  role="tab" aria-controls="v-pills-ficha" aria-selected="true"> 
                                        <i class="fas fa-tachometer-alt"></i> Ficha técnica
                                    </a>
                                    <a class="nav-link" ng-class="{ 'active': tabs == 3 }" ng-click="tabs = 3" id="v-pills-precios-tab" data-toggle="pill"  role="tab" aria-controls="v-pills-precios" aria-selected="true"> 
                                        <i class="fas fa-money-check-alt"></i> Precios
                                    </a>
                                    <a class="nav-link" ng-class="{ 'active': tabs == 4 }" ng-click="tabs = 4" id="v-pills-imagenes-tab" data-toggle="pill"  role="tab" aria-controls="v-pills-imagenes" aria-selected="true"> 
                                        <i class="fas fa-images"></i> Imagenes
                                    </a>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show" ng-class="{ 'show active': tabs == 1 }"   role="tabpanel" aria-labelledby="v-pills-info-tab">
                                        <div class="row fix-width">
                                            <h3 ng-click="printFlow()">INFORMACIÓN GENERAL <i class="fas fa-info-circle"></i></h3>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width form-group">
                                                <div class="col-4">
                                                    <p>Marca</p>
                                                </div>
                                                <div class="col-4">
                                                    <p>Modelo</p>
                                                </div>
                                                <div class="col-4">
                                                    <p>Detalles</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow form-group">
                                                <div class="col-4">
                                                    <select id="motoBrand" type="text" class="form-control" ng-model="moto.idBrand" required ng-options="b.id as b.brand for b in brands"></select>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" class="form-control" ng-model="moto.name" >
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" class="form-control" ng-model="moto.details" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="col-12">
                                                    <p>Imagen descripción</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                            <input type="hidden" value="@{{moto.id}}">
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
                                            </div>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="col-12">
                                                <p>Descripción</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-12">
                                                    <span>@{{moto.description}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" ng-class="{ 'show active': tabs == 2 }"  role="tabpanel" aria-labelledby="v-pills-ficha-tab">
                                        <div class="row fix-width">
                                            <h3><i class="fas fa-tachometer-alt"></i>  FICHA TÉCNICA</h3>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="col-12">
                                                    <h4>Motor</h4>
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-4">
                                                    <p>Tipo</p>
                                                </div>
                                                <div class="col-4">
                                                    <p>Desplazamiento</p>
                                                </div>
                                                <div class="col-4">
                                                    <p>Máx. potencia</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-4">
                                                    <span>@{{moto.engine}}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>@{{moto.displacement}}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>@{{moto.power}}</span>
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-6">
                                                    <p>Max. Torque</p>
                                                </div>
                                                <div class="col-6">
                                                    <p>Arranque</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-6">
                                                    <span>@{{moto.torque}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>@{{moto.start}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="col-12">
                                                    <h4>Transmisión</h4>
                                                </div>    
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-6">
                                                    <p>Sistema de encendido</p>
                                                </div>
                                                <div class="col-6">
                                                    <p>Relación de Compresión</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-6">
                                                    <span>@{{moto.ignition}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>@{{moto.compression}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="col-12">
                                                    <h4>Suspensión</h4>
                                                </div>    
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-6">
                                                    <p>Suspensión delantera</p>
                                                </div>
                                                <div class="col-6">
                                                    <p>Suspensión trasera</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-6">
                                                    <span>@{{moto.frontSuspension}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>@{{moto.backSuspension}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="col-12">
                                                    <h4>Llantas</h4>
                                                </div>    
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-6">
                                                    <p>Llanta delantera</p>
                                                </div>
                                                <div class="col-6">
                                                    <p>llanta trasera</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-6">
                                                    <span>@{{moto.tireFront}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>@{{moto.tireBack}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="col-12">
                                                    <h4>Frenos</h4>
                                                </div>    
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-6">
                                                    <p>Freno delantero</p>
                                                </div>
                                                <div class="col-6">
                                                    <p>Freno trasero</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-6">
                                                    <span>@{{moto.frontBrake}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>@{{moto.rearBrake}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="col-12">
                                                    <h4>Dimensiones</h4>
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-4">
                                                    <p>Largo total</p>
                                                </div>
                                                <div class="col-4">
                                                    <p>Altura Total</p>
                                                </div>
                                                <div class="col-4">
                                                    <p>Ancho total</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-4">
                                                    <span>@{{moto.long}}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>@{{moto.height}}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>@{{moto.width}}</span>
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-4">
                                                    <p>Distancia entre ejes</p>
                                                </div>
                                                <div class="col-4">
                                                    <p>Altura al sillín</p>
                                                </div>
                                                <div class="col-4">
                                                    <p>Peso neto</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-4">
                                                    <span>@{{moto.axisDistance}}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>@{{moto.seatHeight}}</span>
                                                </div>
                                                <div class="col-4">
                                                    <span>@{{moto.weight}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" ng-class="{ 'show active': tabs == 3 }"  role="tabpanel" aria-labelledby="v-pills-precios-tab">
                                        <div class="row fix-width">
                                            <h3><i class="fas fa-money-check-alt"></i> PRECIOS</h3>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="col-6">
                                                    <p>Precio Contado:</p>
                                                </div>
                                                <div class="col-6">
                                                    <p>Precio Lista crédito:</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-6">
                                                    <span>@{{moto.price}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>@{{moto.creditPrice}}</span>
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-6">
                                                    <p>AVAL:</p>
                                                </div>
                                                <div class="col-6">
                                                    <p>SOAT:</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-6">
                                                    <span>@{{moto.aval}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>@{{moto.soat}}</span>
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-6">
                                                    <p>Bonos marca:</p>
                                                </div>
                                                <div class="col-6">
                                                    <p>Matrícula, pignoración y tramitador:</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width row-shadow">
                                                <div class="col-6">
                                                    <span>@{{moto.brandBonus}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>@{{moto.creditEnrollment  }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" ng-class="{ 'show active': tabs == 4 }"  role="tabpanel" aria-labelledby="v-pills-imagenes-tab">
                                        <div class="row fix-width">
                                            <h3><i class="fas fa-images"></i> IMAGENES</h3>
                                        </div>
                                        <div class="colInfo">
                                            <div class="row fix-width">
                                                <div class="offset-2 col-8 text-center">
                                                <p>Imagen principal</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                                <div class="offset-3 col-6">
                                                    <img src="/images/motos/@{{moto.image}}" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                                <div class="offset-2 col-8 text-center">
                                                    <p>Imagenes de detalles</p>
                                                </div>
                                            </div>
                                            <div class="row fix-width">
                                                <div class="col-3" ng-repeat="imageMoto in motoImages">
                                                    <div class="card">
                                                        <img src="/images/motos/motos-vistas/@{{imageMoto.image}}" alt="" class="card-img-top">
                                                        <div class="card-body">
                                                            <p class="card-text">@{{imageMoto.image}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row resetRow">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btnStep">Continuar</button>
                            </div>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>  
