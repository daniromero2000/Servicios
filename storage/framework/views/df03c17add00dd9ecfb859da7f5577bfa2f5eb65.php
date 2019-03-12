    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for PRODUCTS CRUD
    **Fecha: 22/12/2018
     -->


<h2 class="headerAdmin">Administrador de productos</h2>
<div class="row form-group" ng-if="filtros">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <strong>Filtros</strong>
            </div>
            <div class="card-body">
                <form ng-submit="getResource()">
                    <div class="row form-group">
                        <div class="col-12 col-sm-4">
                            <label>Ciudad</label>
                            <select class="form-control" ng-model="q.city" ng-options="city.id as city.name+'('+city.departament+')' for city in cities"></select>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label>Marca</label>
                            <select class="form-control" ng-model="q.brand" ng-options="brand.id as brand.name for brand in brands"></select>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label>Categoria</label>
                            <select class="form-control" ng-model="q.line" ng-options="line.id as line.name for line in lines"></select>
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="button" ng-click="resetFilters()" class="btn btn-danger">Resetear Filtros<i class="fas fa-times"></i></button>
                            <button type="submit" class="btn btn-primary ">Filtrar<i class="fas fa-filter"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row resetRow">

    <div class="col-sm-12 col-md-3">
         <button class="btn btn-primary" ng-click="addResource()">Agregar Producto</button>
    </div>
    <div class="col-sm-12 col-md-3">
      <input type="checkbox" class="form-check-input"  ng-model="q.delete">
      <label class="form-check-label">Mostrar inactivos</label>
    </div>

    <div class="col-sm-12 offset-md-2 col-md-4 text-right">
        <div class="input-group mb-3">
            <div class="input-group-append">
                <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
                <span class="input-group-text" id="searchIcon" ng-click="search()"><i class="fas fa-search"></i></span>
            </div>
            <div class="col-sm-12 col-md-1 resetCol">
                <button type="button" ng-click="filtros=!filtros" class="btn btn-primary btnFilter">Filtros <i class="fas fa-filter"></i></button>
            </div>
        </div>
    </div>

</div>
<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th scope="col" width="18%">Nombre</th>
                <th scope="col" width="18%">Referencia</th>
                <th scope="col" width="18%">Precio</th>
                <th scope="col" width="18%">Marca</th>
                <th scope="col" width="18%">Ciudad</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="resource in resources">
                <td>{{ resource.name }}</td>
                <td>{{ resource.reference }}</td>
                <td>{{ resource.price }}</td>
                <td>{{ resource.brand }}</td>
                <td>{{ resource.city }}</td>
              <td> 
                    <i class="fas fa-eye cursor" title="Ver" ng-click="showDialog(resource)"></i>
                    <i class="fas fa-edit cursor" title="Actualizar" ng-click="showUpdateDialog(resource)"></i>
                    <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDelete(resource)"></i>
                       
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="moreRegister()">Cargar Más</button>
        </div>
    </div>
</div>


      <!-- Modal Create -->
        <div class="modal fade" id="addResourceModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nuevo producto</h5>
              </div>
              <div class="modal-body">
                <form ng-submit="createResource()">
                  <div class="form-group">
                    <label>Nombre del producto</label>
                    <input class="form-control" ng-model="resource.name" required >
                  </div>
                  <div class="form-group">
                    <label>Referencia</label>
                    <input class="form-control" ng-model="resource.reference" required >
                  </div>
                  <div class="form-group">
                    <label>Especificaciones</label>
                    <textarea rows="2" class="form-control" ng-model="resource.specifications" required ></textarea>
                    
                  </div>
                  <div class="form-group">
                    <label>Precio a crédito</label>
                    <input type="number" class="form-control" ng-model="resource.price" required >
                  </div>
                  <div class="form-group">
                    <label>Marca</label>
                    <select class="form-control" ng-model="resource.idBrand">
                      <option ng-repeat="brand in brands" value="{{brand.id}}">{{brand.name}}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Linea</label>
                    <select class="form-control" ng-model="resource.idLine">
                      <option ng-repeat="line in lines" value="{{line.id}}">{{line.name}}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Ciudad</label>
                    <select class="form-control" ng-model="resource.idCity">
                      <option ng-repeat="city in cities" value="{{city.id}}">{{city.name}}</option>
                    </select>
                  </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
              </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
        
               <!-- Modal DELETE-->

        <div class="modal fade" id="Delete" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar este perfil?</h5>
            </div>
              <div class="modal-body">
        
                  <div class="form-group">
                    <label>Nombre</label>
                    <textarea class="form-control textareaReadOnly" name="question" ng-model="resource.name" readonly></textarea>
                  </div>  
              </div>
              <div class="modal-footer">
                <form ng-submit = "deleteResource(resource.id)">
                    
                    <button class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

     <!-- Modal show -->
     <div class="modal fade" id="Show" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Producto</h5>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                        <label>Nombre del producto</label>
                        <input class="form-control" ng-model="resource.name" readOnly >
                      </div>
                      <div class="form-group">
                        <label>Referencia</label>
                        <input class="form-control" ng-model="resource.reference" readOnly >
                      </div>
                      <div class="form-group">
                        <label>Especificaciones</label>
                        <textarea rows="2" class="form-control" ng-model="resource.specifications" readOnly ></textarea>
                        
                      </div>
                      <div class="form-group">
                        <label>Precio a crédito</label>
                        <input type="number" class="form-control" ng-model="resource.price" readOnly >
                      </div>
                      <div class="form-group">
                        <label>Marca</label>
                        <input type="text" class="form-control" ng-model="resource.brand" readOnly >
                      </div>
                      <div class="form-group">
                        <label>Categoria</label>
                         <input type="text" class="form-control" ng-model="resource.line" readOnly >
                      </div>
                      <div class="form-group">
                        <label>Ciudad</label>
                         <input type="text" class="form-control" ng-model="resource.city" readOnly >
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

         <!-- Modal Update -->
        <div class="modal fade" id="Update" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Actualizar Perfil</h5>
              </div>
              <div class="modal-body">
                <form ng-submit="UpdateResource()">
                  <div class="form-group">
                    <label>Nombre</label>
                    <textarea rows="2" class="form-control" name="question"  ng-model="resource.name" required ></textarea>
                  </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

