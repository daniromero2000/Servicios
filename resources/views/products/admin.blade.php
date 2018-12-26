    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for PRODUCTS CRUD
    **Fecha: 22/12/2018
     -->
<h2 class="headerAdmin">Administrador de productos</h2>
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
        </div>
    </div>
</div>
<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th scope="col" width="90%">Nombre</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="resource in resources">
                <td>@{{ resource.name }}</td>
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
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="q.actual = q.actual + 1; getResource()">Cargar Más</button>
        </div>
    </div>
</div>


      <!-- Modal Create -->
        <div class="modal fade" id="addResourceModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nuevo perfil</h5>
              </div>
              <div class="modal-body">
                <div class="alert alert-danger" role="alert" id="alertResource"><span id="p"></span></div>
                <form ng-submit="createResource()">
                  <div class="form-group">
                    <label>Nombre del producto</label>
                     <input class="form-control" ng-model="resource.name" required >
                  </div>
               
                  
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                   </form>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
              </div>
              
            </div>
          </div>
        </div>
        <div>
        
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
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Perfil</h5>
            </div>
              <div class="modal-body">
        
                  <div class="form-group">
                    <label>Nombre</label>
                    <textarea rows="2" class="form-control textareaReadOnly" ng-model="resource.name" readonly></textarea>
                  </div>        
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                  <div class="alert alert-danger" role="alert" id="alertUpdate"><span id="update"></span></div>
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

