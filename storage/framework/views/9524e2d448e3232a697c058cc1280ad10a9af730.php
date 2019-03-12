    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for FAQS CRUD
    **Fecha: 12/12/2018
     -->
<h2 class="headerAdmin">Administrador de marcas</h2>
<div class="row resetRow">

    <div class="col-sm-12 col-md-3">
         <button class="btn btn-primary" ng-click="addBrand()">Agregar Marca</button>
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
                <th scope="col" width="90%">Marca</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="brand in brands">
                <td>{{ brand.name }}</td>
                <td>
                    <i class="fas fa-edit cursor" title="Actualizar" ng-click="showUpdateDialog(brand)"></i>
                    <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDelete(brand)" ng-if='activ'></i>
                       
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
        <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nueva Marca</h5>
              </div>
              <div class="modal-body">
                <div class="alert alert-danger" role="alert" id="alertBrand"><span id="p"></span></div>
                <form ng-submit="createBrand()">
                  <div class="form-group">
                    <label>Marca</label>
                    <div>
                        <div class="row rowBrands">
                            <div class = "col-sm-10"><input class="form-control" ng-model="brand.name" required ></div>
                            <div class = "col-sm-2"><button type="submit" class="btn btn-primary">Guardar</button></div>
                        </div>    
                    </div> 
                  </div>
                </form>
                  
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
              
            </div>
          </div>
        </div>

               <!-- Modal DELETE-->

        <div class="modal fade" id="Delete" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar esta marca?</h5>
            </div>
              <div class="modal-body">
        
                  <div class="form-group">
                    <label>Nombre</label>
                    <textarea class="form-control textareaReadOnly" name="question" ng-model="brand.name" readonly></textarea>
                  </div>  
              </div>
              <div class="modal-footer">
                <form ng-submit = "deleteBrand(brand.id)">
                    
                    <button class="btn btn-danger">Eliminar</button>
                </form>
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
                <h5 class="modal-title">Actualizar Marca</h5>
              </div>
              <div class="modal-body">
                <form ng-submit="UpdateBrand()">
                  <div class="alert alert-danger" role="alert" id="alertUpdate"><span id="update"></span></div>
                  <div class="form-group">
                    <label>Nombre</label>
                    <textarea rows="2" class="form-control" name="question"  ng-model="brand.name" required ></textarea>
                  </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

