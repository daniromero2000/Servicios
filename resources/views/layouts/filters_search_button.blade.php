
<div class="col-sm-12 offset-md-7 col-md-3 text-right">
  <div class="input-group mb-3">
    <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
    <div class="input-group-append">
      <span class="input-group-text" id="searchIcon" ng-click="searchLeads()"><i class="fas fa-search"></i></span>
    </div>
  </div>
</div>
<div class="col-sm-12 col-md-1 resetCol">
  <button type="button" ng-click="filtros=!filtros" class="btn btn-primary btnFilter">Filtros <i
      class="fas fa-filter"></i></button>
</div>