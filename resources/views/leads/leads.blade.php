<style>
    td {
        vertical-align: middle !important;
    }

    .container {
        max-width: 1300px !important;
        margin: auto;
    }
</style>

<nav>
    <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
        <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }" ng-click="tabs = 1"
            data-toggle="tab" role="tab" aria-controls="nav-general">Aprobados</a>
        <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 2 }" ng-click="tabs = 2"
            data-toggle="tab" role="tab" aria-controls="nav-general">Tradicional</a>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade card  mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
        ng-class="{ 'show active': tabs == 1 }" style="box-shadow: 0 3rem 4rem rgba(0,0,0,.175) !important;">
        <div class="row form-group" ng-if="filtros">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <strong>Filtros</strong>
                    </div>
                    <div class="card-body">
                        <form ng-submit="searchLeads()">
                            <div class="row form-group">
                                <div class="col-12 col-sm-4">
                                    <label>Ciudad</label>
                                    <select class="form-control" ng-model="q.qcityAprobados"
                                        ng-options="city.CIUDAD as city.CIUDAD for city in cities"></select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="qtipoTarjetaAprobados">Tipo Tarjeta</label>
                                    <select class="form-control" ng-model="q.qtipoTarjetaAprobados"
                                        id="qtipoTarjetaAprobados"
                                        ng-options="cardType.label as cardType.label for cardType in cardTypes"></select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="qOrigenAprobados">Origen</label>
                                    <select class="form-control" ng-model="q.qOrigenAprobados" id="qOrigenAprobados"
                                        ng-options="origen.value as origen.label for origen in origenes"></select>
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-sm-6">
                                    <label for="fechaInicialAprobados">Fecha Inicial</label>
                                    <div class="input-group" moment-picker="q.qfechaInicialAprobados"
                                        format="YYYY-MM-DD">
                                        <input class="form-control inputsSteps inputText"
                                            ng-model="q.qfechaInicialAprobados" id="fechaInicialAprobados" readonly=""
                                            required="" placeholder="Año/Mes/Día">
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="qfechaFinalAprobados">Fecha Final</label>
                                    <div class="input-group" moment-picker="q.qfechaFinalAprobados" format="YYYY-MM-DD">
                                        <input class="form-control inputsSteps inputText"
                                            ng-model="q.qfechaFinalAprobados" id="qfechaFinalAprobados" readonly=""
                                            required="" placeholder="Año/Mes/Día">
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" ng-click="resetFiltros()" class="btn btn-danger">Resetear
                                        Filtros<i class="fas fa-times"></i></button>
                                    <button type="submit" class="btn btn-primary ">Filtrar<i
                                            class="fas fa-filter"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-header bg-white border-bottom-0">
                <div class="row resetRow">
                    <div class="col-sm-12 col-md-1">
                        <p class="totalLeadsDigital text-center">
                            @{{ totalLeads }}
                        </p>
                        <p class="text-center">
                            Leads
                        </p>
                    </div>
                    @include('layouts.filters_search_button')
                </div>
            </div>


            <div class="card-body">
                <div class="table reset-table">
                    <table id="example2"
                        class="table table-responsive-lg table-stripped leadTable  text-center table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Cedula</th>
                                <th scope="col">Sucursal / N° solicitud</th>
                                <th scope="col">Asesor</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Tarjeta</th>
                                <th scope="col">Origen</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Cupo Producto/Avance</th>
                                <th scope="col">Producto</th>
                                <th scope="col" style="width: 10%;">Fecha registro</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="lead in leads">
                                <td>@{{ lead.CEDULA }}</td>
                                <td>@{{ lead.SUCURSAL }} - @{{ lead.SOLICITUD }}</td>
                                <td>@{{ lead.nameAsesor }}</td>
                                <td>@{{ lead.NOMBRES + " " + lead.APELLIDOS }}</td>
                                <td>@{{ lead.CELULAR }}</td>
                                <td>@{{ lead.TARJETA }}</td>
                                <td>@{{ lead.ORIGEN }} <span
                                        ng-if="lead.ORIGEN == 'SEGUROS'"><b>@{{ " / " + lead.PLACA }}</b></span> </td>
                                <td>@{{ lead.CIUD_UBI }}</td>
                                <td>
                                    $ @{{ lead.CUP_COMPRA | number:0 }} <br> / $ @{{ lead.CUPO_EFEC | number:0 }}
                                </td>
                                <td>@{{ lead.product_id }}</td>
                                <td>@{{ lead.FECHASOL }}</td>
                                <td>
                                    <i ng-if="lead.ASESOR_DIG != NULL" class="fas fa-comment cursor"
                                        ng-click="viewCommentsFactoryRequest(lead.NOMBRES, lead.APELLIDOS, lead.SOLICITUD)"></i>
                                    <i ng-if="lead.ASESOR_DIG == NULL" class="fas fa-check cursor"
                                        ng-click="assignAssesorDigitalToLead(lead.SOLICITUD)"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getLeads()">Cargar
                                Más</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewFactoryRequestComments" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ver Comentarios - @{{ nameLead }} @{{ lastNameLead }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row resetRow " ng-if="viewAddComent">
                                <div class="col-12 form-group">
                                    <form ng-submit="addFactoryRequestComment()">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="comment">Comentario</label>
                                            <textarea ng-model="comment.comment" id="comment" cols="10"
                                                class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group text-left">
                                            <button class="btn btn-primary">Agregar</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                            </div>
                            <div class="row resetRow">
                                <div class="col-12 text-right form-group">
                                    <button type="button" ng-click="viewCommentChange()" class="btn btn-secondary"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="containerCommentsLeads">
                                <div ng-repeat="comment in comments"
                                    class="row resetRow form-group contianerCommentLead">
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

        <div class="modal fade" id="viewComments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ver Comentarios - @{{ nameLead }} @{{ lastNameLead }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row resetRow " ng-if="viewAddComent">
                                <div class="col-12 form-group">
                                    <form ng-submit="addComment()">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="comment">Comentario</label>
                                            <textarea ng-model="comment.comment" id="comment" cols="10"
                                                class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group text-left">
                                            <button class="btn btn-primary">Agregar</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                            </div>
                            <div class="row resetRow">
                                <div class="col-12 text-right form-group">
                                    <button type="button" ng-click="viewCommentChange()" class="btn btn-secondary"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="containerCommentsLeads">
                                <div ng-repeat="comment in comments"
                                    class="row resetRow form-group contianerCommentLead">
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
    <div class="tab-pane fade card mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
        ng-class="{ 'show active': tabs == 2 }" style="box-shadow: 0 3rem 4rem rgba(0,0,0,.175) !important;">
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
                                    <label>Ciudad</label>
                                    <select class="form-control" ng-model="q.qcityAprobados"
                                        ng-options="city.CIUDAD as city.CIUDAD for city in cities"></select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="qOrigenTR">Origen</label>
                                    <select class="form-control" ng-model="q.qOrigenTR" id="qOrigenTR"
                                        ng-options="origen.value as origen.label for origen in origenes"></select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-sm-6">
                                    <label for="qfechaInicialTR">Fecha Inicial</label>
                                    <div class="input-group" moment-picker="q.qfechaInicialTR" format="YYYY-MM-DD">
                                        <input class="form-control inputsSteps inputText" ng-model="q.qfechaInicialTR"
                                            id="qfechaInicialTR" readonly="" required="" placeholder="Año/Mes/Día">
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="qfechaFinalTR">Fecha Final</label>
                                    <div class="input-group" moment-picker="q.qfechaFinalTR" format="YYYY-MM-DD">
                                        <input class="form-control inputsSteps inputText" ng-model="q.qfechaFinalTR"
                                            id="qfechaFinalTR" readonly="" required="" placeholder="Año/Mes/Día">
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" ng-click="resetFiltros()" class="btn btn-danger">Resetear
                                        Filtros<i class="fas fa-times"></i></button>
                                    <button type="submit" class="btn btn-primary ">Filtrar<i
                                            class="fas fa-filter"></i></button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-header bg-white border-bottom-0">
                <div class="row resetRow">
                    <div class="col-sm-12 col-md-1">
                        <p class="totalLeadsDigital text-center">
                            @{{ totalLeadsTR }}
                        </p>
                        <p class="text-center">
                            Leads
                        </p>
                    </div>
                    @include('layouts.filters_search_button')
                </div>
            </div>
            <div class="card-body">
                <div class="table reset-table">
                    <table id="example2"
                        class="table text-center table-responsive-lg table-stripped leadTable  table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Cedula</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Email</th>
                                <th scope="col">Origen</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Definición</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Fecha Intención</th>
                                <th scope="col">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="lead in leadsTR">
                                <td>@{{ lead.CEDULA }}</td>
                                <td>@{{ lead.NOMBRES + ' ' + lead.APELLIDOS }}</td>
                                <td>@{{ lead.CELULAR }}</td>
                                <td>@{{ lead.EMAIL }}</td>
                                <td>@{{ lead.ORIGEN }} <span
                                        ng-if="lead.ORIGEN == 'SEGUROS'"><b>@{{ " / " + lead.PLACA }}</b></span> </td>
                                <td>@{{ lead.CIUD_UBI }}</td>
                                <td>@{{ lead.DESCRIPCION }}</td>
                                <td>@{{ lead.product_id }}</td>
                                <td>@{{ lead.FECHA_INTENCION }}</td>
                                <td>@{{ lead.score }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <button class="btn btn-secondary" ng-disabled="cargandoTR" ng-click="getLeads()">Cargar
                                Más</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade card mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
        ng-class="{ 'show active': tabs == 5 }" style="box-shadow: 0 3rem 4rem rgba(0,0,0,.175) !important;">
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
                                    <label>Ciudad</label>
                                    <select class="form-control" ng-model="q.qcityAprobados"
                                        ng-options="city.CIUDAD as city.CIUDAD for city in cities"></select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label>Canal</label>
                                    <select class="form-control" ng-model="q.qleadChannel"
                                        ng-options="leadsChannel.value as leadsChannel.label for leadsChannel in leadsChannels"></select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-sm-6">
                                    <label for="fechaInicialAprobados">Fecha Inicial</label>
                                    <div class="input-group" moment-picker="q.qfechaInicialAprobados"
                                        format="YYYY-MM-DD">
                                        <input class="form-control inputsSteps inputText"
                                            ng-model="q.qfechaInicialAprobados" id="fechaInicialAprobados" readonly=""
                                            required="" placeholder="Año/Mes/Día">
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="qfechaFinalAprobados">Fecha Final</label>
                                    <div class="input-group" moment-picker="q.qfechaFinalAprobados" format="YYYY-MM-DD">
                                        <input class="form-control inputsSteps inputText"
                                            ng-model="q.qfechaFinalAprobados" id="qfechaFinalAprobados" readonly=""
                                            required="" placeholder="Año/Mes/Día">
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" ng-click="resetFiltros()" class="btn btn-danger">Resetear
                                        Filtros<i class="fas fa-times"></i></button>
                                    <button type="submit" class="btn btn-primary ">Filtrar<i
                                            class="fas fa-filter"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-header bg-white border-bottom-0">
                <div class="row resetRow">
                    <div class="col-sm-12 col-md-1">
                        <div class="col-sm-12 col-md-2  ">
                            <button class="btn btn-primary">
                                <a ng-click="addCommunityForm()">Agregar Lead <i class="far fa-plus-square"></i></a>
                            </button>
                        </div>
                        <p class="totalLeadsDigital text-center">
                            @{{ totalLeadsCM }}
                        </p>
                        <p class="text-center">
                            Leads
                        </p>
                    </div>
                    @include('layouts.filters_search_button')
                </div>
            </div>
            <div class="card-body">
                <div class="table reset-table">
                    <table id="example2"
                        class="table table-responsive table-stripped leadTable text-center table-hover">
                        <thead class=" text-center">
                            <tr>
                                <th scope="col">Estado</th>
                                <th scope="col">Lead</th>
                                <th scope="col">Asesor</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Servicio</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="leadCM in leadsCM">
                                <td>
                                    <span class="text-center badge" ng-if="leadCM.state == 1"
                                        style="color: #ffffff; background-color: blue"
                                        class="btn btn-info btn-block">Contactado</span>
                                    <span class="text-center badge" ng-if="leadCM.state == 2"
                                        style="color: #ffffff; background-color: green"
                                        class="btn btn-info btn-block">Vendido</span>
                                    <span class="text-center badge badge-warning" ng-if="leadCM.state == 3"
                                        class="btn btn-info btn-block">Asignado a:</span>
                                    <span class="text-center badge" ng-if="leadCM.state == 4"
                                        style="color: #ffffff; background-color: purple"
                                        class="btn btn-info btn-block">Impactado</span>
                                    <span class="text-center badge" ng-if="leadCM.state == 5"
                                        style="color: #ffffff; background-color: orange"
                                        class="btn btn-info btn-block">Desistido</span>
                                    <span class="text-center badge" ng-if="leadCM.state == 6"
                                        style="color: #ffffff; background-color: red"
                                        class="btn btn-info btn-block">Negado</span>
                                    <span class="text-center badge" ng-if="leadCM.state == 7"
                                        style="color: #ffffff; background-color: pink"
                                        class="btn btn-info btn-block">Cotizado</span>
                                    <span class="text-center badge" ng-if="leadCM.state == 8"
                                        style="color: #ffffff; background-color: green" class="btn btn-info btn-block">En
                                        Gestión</span>
                                </td>
                                <td>
                                    <span ng-if="leadCM.channel == 2">Facebook</span>
                                    <span ng-if="leadCM.channel == 3">WhatsApp</span>
                                </td>
                                <td>@{{ leadCM.nameAsesor }}</td>
                                <td>@{{ leadCM.identificationNumber }}</td>
                                <td>@{{ leadCM.name + " " + leadCM.lastName }}</td>
                                <td>@{{ leadCM.email }}</td>
                                <td>@{{ leadCM.telephone }}</td>
                                <td ng-if="leadCM.nearbyCity == null">@{{ leadCM.city }}</td>
                                <td ng-if="leadCM.nearbyCity != null">@{{ leadCM.city + " / " + leadCM.nearbyCity}}
                                </td>

                                <td>@{{ leadCM.typeService }}</td>
                                <td>@{{ leadCM.typeProduct }}</td>
                                <td>@{{ leadCM.created_at }}</td>
                                <td>
                                    <i class="fas fa-edit cursor" title="Actualizar Lead"
                                        ng-click="showUpdateDialog(leadCM.id)"></i>
                                    <i class="fas fa-comment cursor"
                                        ng-click="viewCommentsCM(leadCM.name, leadCM.lastName, leadCM.state, leadCM.id)"></i>
                                    <i ng-if="leadCM.state == 1" class="fas fa-check cursor"
                                        title="Marcar cliente como procesado"
                                        ng-click="checkLeadProcess(leadCM.id)"></i>
                                    <i class="fas fa-times cursor" title="Eliminar Lead"
                                        ng-click="showDialogDelete(leadCM.id)"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <button class="btn btn-secondary" ng-disabled="cargandoCM" ng-click="getLeads()">Cargar
                                Más</button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="viewCommentsCM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Ver Comentarios - @{{ nameLead }}
                                    @{{ lastNameLead }}
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row resetRow " ng-if="viewAddComent">
                                        <div class="col-12 form-group">
                                            <form ng-submit="addComment()">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="comment">Comentario</label>
                                                    <textarea ng-model="comment.comment" id="comment" cols="10"
                                                        class="form-control" required></textarea>
                                                </div>
                                                <div class="form-group text-left">
                                                    <button class="btn btn-primary">Agregar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row resetRow">
                                        <div class="col-12 text-right form-group">
                                            <button type="button" ng-click="viewCommentChange()"
                                                class="btn btn-secondary"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="containerCommentsLeads">
                                        <div ng-repeat="comment in comments"
                                            class="row resetRow form-group contianerCommentLead">
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
        </div>
    </div>

    <div class="tab-pane fade card  mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
        ng-class="{ 'show active': tabs == 6 }" style="box-shadow: 0 3rem 4rem rgba(0,0,0,.175) !important;">
        <div class="card border-0">
            <div class="card-header bg-white border-bottom-0">
                <div class="row resetRow">
                    <div class="col-sm-12 col-md-1">
                        <p class="totalLeadsDigital text-center">
                            @{{ totalLeadsGen }}
                        </p>
                        <p class="text-center">
                            Leads
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-3 offset-md-7 text-center col-md-3">

                        <div class="input-group mb-3">
                            <input type="text" ng-model="q.qGen" class="form-control" aria-describedby="searchIcon">
                            <div class="input-group-append">
                                <span class="input-group-text" id="searchIcon" ng-click="searchLeads()"><i
                                        class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table reset-table ">
                    <table id="example2"
                        class="table table-responsive-lg table-stripped leadTable text-center table-hover">
                        <thead class=" text-center">
                            <tr>
                                <th scope="col">Estado</th>
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
                            <tr ng-repeat="leadGen in leadsGen">
                                <td>
                                    <i ng-if="leadGen.state == 1" class="fas fa-clock"
                                        title="Cliente en espera de procesar"></i>
                                    <i style="color: green" ng-if="leadGen.state == 2" class="fas fa-check-double"
                                        title="Cliente procesado"></i>
                                </td>
                                <td>@{{ leadGen.name + " " + leadGen.lastName }}</td>
                                <td>@{{ leadGen.email }}</td>
                                <td>@{{ leadGen.telephone }}</td>
                                <td ng-if="leadGen.nearbyCity == null">@{{ leadGen.city }}</td>
                                <td ng-if="leadGen.nearbyCity != null">
                                    @{{ leadGen.city + " / " + leadGen.nearbyCity}}
                                </td>
                                <td>@{{ leadGen.typeService }}</td>
                                <td>@{{ leadGen.created_at }}</td>
                                <td>

                                    <i ng-if="leadGen.state == 1" class="fas fa-check cursor"
                                        title="Marcar cliente como procesado"
                                        ng-click="checkLeadProcess(leadGen.id)"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <button class="btn btn-secondary" ng-disabled="cargandoGen" ng-click="getLeads()">Cargar
                                Más</button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="viewCommentsCM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Ver Comentarios - @{{ nameLead }}
                                    @{{ lastNameLead }}
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row resetRow " ng-if="viewAddComent">
                                        <div class="col-12 form-group">
                                            <form ng-submit="addComment()">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="comment">Comentario</label>
                                                    <textarea ng-model="comment.comment" id="comment" cols="10"
                                                        class="form-control" required></textarea>
                                                </div>
                                                <div class="form-group text-left">
                                                    <button class="btn btn-primary">Agregar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row resetRow">
                                        <div class="col-12 text-right form-group">
                                            <button type="button" ng-click="viewCommentChange()"
                                                class="btn btn-secondary"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="containerCommentsLeads">
                                        <div ng-repeat="comment in comments"
                                            class="row resetRow form-group contianerCommentLead">
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
        </div>
    </div>

    <!--Update modal-->
    <div class="modal fade" id="updateCommunityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Actualizar Lead</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row resetRow ">
                            <div class="col-12 form-group">
                                <form ng-submit="updateCommunityLeads()">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label for="name">Nombre <span class="text-danger">*</span></label>
                                            <input type="text" ng-model="lead.name" validation-pattern="name" id="name"
                                                cols="10" class="form-control" value="@{{ lead.name }}" required>
                                        </div>
                                        <div class="col-12 col-sm-6 no-padding-right">
                                            <label for="lastName">Apellido <span class="text-danger">*</span></label>
                                            <input type="text" ng-model="lead.lastName" validation-pattern="name"
                                                id="lastName" cols="10" class="form-control" value="@{{lead.lastName}}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label for="email">email </label>
                                            <input type="text" ng-model="lead.email" validation-pattern="email"
                                                id="email" cols="10" class="form-control" value="@{{lead.email}}">
                                        </div>
                                        <div class="col-12 col-sm-6 no-padding-right">
                                            <label for="telephone">telefono <span class="text-danger">*</span></label>
                                            <input type="text" ng-model="lead.telephone" id="telephone" cols="10"
                                                class="form-control" value="@{{lead.telephone}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label for="city">Ciudad <span class="text-danger">*</span></label>
                                            <select id="city" class="form-control" ng-model="lead.city"
                                                ng-options="city.CIUDAD as city.CIUDAD for city in cities">
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 no-padding-right">
                                            <label for="socialNetwork">Canal de adquisición <span
                                                    class="text-danger">*</span></label>
                                            <select id="socialNetwork" class="form-control" ng-model="lead.channel"
                                                ng-options="socialNetwork.value as socialNetwork.label for socialNetwork in socialNetworks">
                                                <option>
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 form-group">
                                            <label for="name">Ciudad aledaña</label>
                                            <input type="text" ng-model="lead.nearbyCity" validation-pattern="name"
                                                id="nearbyCity" cols="10" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="socialNetwork">Campaña</label>
                                        <select id="socialNetwork" class="form-control" ng-model="lead.campaign"
                                            ng-options="campaign.id as campaign.name for campaign in campaigns">
                                            <option ng-repeat="campaign in campaigns" value="@{{ campaigns.value}}"
                                                label="@{{ campaigns.label}}">
                                                @{{campaigns.value}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label for="service">Servicio <span class="text-danger">*</span></label>
                                            <select id="service" class="form-control" ng-model="lead.typeService">
                                                <option ng-repeat="service in typeServices" value="@{{service.value}}"
                                                    label="@{{service.label}}">
                                                    @{{service.value}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 no-padding-right">
                                            <label for="product">Producto <span class="text-danger">*</span></label>
                                            <input type="text" ng-model="lead.typeProduct" validation-pattern="text"
                                                id="product" cols="10" class="form-control"
                                                value="@{{lead.typeProduct}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 d-flex align-items-end">
                                            <div class="form-group w-100">
                                                <label for="state">Estado</label>
                                                <select class="form-control  select2" id="state" name="state"
                                                    ng-model="lead.state" style="width: 100%;">
                                                    <option disabled selected value> -- Selecciona Estado -- </option>
                                                    <option value="1">Contactado</option>
                                                    <option value="2">Vendido</option>
                                                    <option value="3">Asignado a:</option>
                                                    <option value="4">Impactado</option>
                                                    <option value="5">Desistido</option>
                                                    <option value="6">Negado</option>
                                                    <option value="7">Cotizado</option>
                                                    <option value="8">En Gestión</option>
                                                    <option value="9">Cerrado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex align-items-end">
                                            <div class="form-group w-100">
                                                <label for="assessor_id">Asesor</label>
                                                <select class="form-control  select2" id="assessor_id"
                                                    name="assessor_id" ng-model="lead.assessor_id" style="width: 100%;">
                                                    <option disabled selected value> -- Selecciona Asesor -- </option>
                                                    <option value="13">Evelyn Correa</option>
                                                    <option value="18">Vanessa Parra</option>
                                                    <option value="85">Danitza Naranjo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-left">
                                        <button class="btn btn-primary">Actualizar</button>
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
    <!--AddCommunityLead modal-->
    <div class="modal fade" id="addCommunityLead" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Agregar Lead</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row resetRow ">
                            <form ng-submit="addCommunityLeads()" id="addCommunityForm">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <label for="identificationNumber">Cédula</label>
                                        <input type="text" class="form-control"
                                            validation-pattern="IdentificationNumber" id="identificationNumber"
                                            ng-model="lead.identificationNumber">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 form-group">
                                        <label for="name">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" ng-model="lead.name" validation-pattern="name" id="name"
                                            cols="10" class="form-control" required>
                                    </div>
                                    <div class="col-12 col-sm-6 form-group no-padding-right">
                                        <label for="lastName">Apellido <span class="text-danger">*</span></label>
                                        <input type="text" ng-model="lead.lastName" validation-pattern="name"
                                            id="lastName" cols="10" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 form-group">
                                        <label for="email">Email</label>
                                        <input type="text" ng-model="lead.email" validation-pattern="email" id="email"
                                            cols="10" class="form-control">
                                    </div>
                                    <div class="col-12 col-sm-6 form-group no-padding-right">
                                        <label for="telephone">Teléfono <span class="text-danger">*</span></label>
                                        <input type="text" ng-model="lead.telephone" id="telephone" cols="10"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 form-group">
                                        <label for="city">Ciudad <span class="text-danger">*</span></label>
                                        <select id="city" class="form-control" ng-model="lead.city" required
                                            ng-options="city.CIUDAD as city.CIUDAD for city in cities">
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 form-group no-padding-right">
                                        <label for="socialNetwork">Canal de Adquisición <span
                                                class="text-danger">*</span></label>
                                        <select id="socialNetwork" class="form-control" ng-model="lead.channel">
                                            <option ng-repeat="socialNetwork in socialNetworks"
                                                value="@{{socialNetwork.value}}">
                                                @{{socialNetwork.label}}
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 form-group">
                                        <label for="name">Ciudad aledaña</label>
                                        <input type="text" ng-model="lead.nearbyCity" validation-pattern="name"
                                            id="nearbyCity" cols="10" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <label for="socialNetwork">Campaña</label>
                                        <select id="socialNetwork" class="form-control" ng-model="lead.campaign"
                                            required>
                                            <option ng-repeat="campaign in campaigns" value="@{{campaign.name}}">
                                                @{{campaign.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 form-group">
                                        <label for="service">Servicio <span class="text-danger">*</span></label>
                                        <select id="service" class="form-control" ng-model="lead.typeService">
                                            <option ng-repeat="service in typeServices" value="@{{service.value}}">
                                                @{{service.value}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 form-group no-padding-right">
                                        <label for="product">Producto <span class="text-danger">*</span></label>
                                        <input type="text" ng-model="lead.typeProduct" validation-pattern="text"
                                            id="product" cols="10" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-3 d-flex align-items-end">
                                    <div class="form-group w-100">
                                        <label for="assessor_id">Asesor</label>
                                        <select class="form-control  select2" id="assessor_id" name="assessor_id"
                                            ng-model="lead.assessor_id" style="width: 100%;">
                                            <option disabled selected value> -- Selecciona Paso -- </option>
                                            <option value="13">Evelyn Correa</option>
                                            <option value="18">Vanessa Parra</option>
                                            <option value="85">Danitza Naranjo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <button class="btn btn-primary">Agregar</button>
                                    <button class=" btn btn-danger" data-dismiss="modal"
                                        aria-label="Close">Cancelar</button>
                                </div>
                            </form>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row resetRow ">
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