 
<div class="col-sm-8 col-md-8 col-lg-7 offset-xl-1 text-center col-md-3 text-right">
    <div class="input-group mb-3">
      <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
      <div class="input-group-append">
        <span class="input-group-text" id="searchIcon" ng-click="searchLeads()"><i class="fas fa-search"></i></span>
      </div>
    </div>
  </div>
  <div class="col-sm-2 col-md-2 col-lg-3 col-xl-2 text-center resetCol">
    <button type="button" ng-click="filtros=!filtros" class="btn btn-primary btnFilter">Filtros <i
        class="fas fa-filter"></i></button>
  </div>