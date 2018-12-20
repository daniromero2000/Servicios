    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for CRUD of brands lines and products.
    **Fecha: 13/12/2018
     -->
<div class="row resetRow">

    <div class="col-sm-12 col-md-4">
         <button class="btn btn-primary" ng-click="addBrand()">Agregar Marca</button>
    </div>
</div>

<!-- Modal Create Brand -->
        <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nueva Marca</h5>
              </div>
              <div class="modal-body">
                <form ng-submit="createBrand()">
                  <div class="form-group">
                    <label>Marca</label>
                    <div>
                        <div class="row rowBrands">
                            <div class = "col-sm-4"><input class="form-control" ng-model="brand.name" required ></div>
                            <div class = "col-sm-2"><button type="submit" class="btn btn-primary">Guardar</button></div>
                            <div class="col-sm-6 row rowBrands">
                                <input type="text" ng-model="query" class="form-control col-sm-10" aria-describedby="searchIcon">
                                <span class="input-group-text" id="searchIcon" ng-click="search()"><i class="fas fa-search"></i></span>
                            </div>
                        </div>    
                    </div> 
                  </div>
                </form>
                  
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
              </div>
              
            </div>
          </div>
        </div>