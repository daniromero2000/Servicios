    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for FAQS CRUD
    **Fecha: 12/12/2018
     -->

<div class="row resetRow">

    <div class="col-sm-12 col-md-4">
         <button class="btn btn-primary" ng-click="addFaq()">Agregar FAQ's</button>
    </div>

    <div class="col-sm-12 offset-md-3 col-md-4 text-right">
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
                <th scope="col" width="90%">Pregunta</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="faq in faqs">
                <td>{{ faq.question }}</td>
                <td>
                    <i class="fas fa-eye cursor" title="Ver" ng-click="showDialog(faq)"></i>
                    <i class="fas fa-edit cursor" title="Actualizar" ng-click="showUpdateDialog(faq)"></i>
                    <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDelete(faq)"></i>
                    
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="q.actual = q.actual + 1; getFaqs()">Cargar Más</button>
        </div>
    </div>
</div>


       <!-- Modal Create -->
        <div class="modal fade" id="addFaqModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nueva Pregunta Frecuente</h5>
              </div>
              <div class="modal-body">
                <form ng-submit="createFaq()">
                  <?php echo e(csrf_field()); ?>

                  <div class="form-group">
                    <label>Pregunta</label>
                    <textarea rows="2" class="form-control" name="question"  ng-model="faq.question" required ></textarea>
                  </div>
                  <div class="form-group">
                    <label>Respuesta</label>
                    <textarea rows="4" class="form-control" name="answer" ng-model="faq.answer" required></textarea>
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
                <h5 class="modal-title">¿Desea eliminar esta pregunta?</h5>
            </div>
              <div class="modal-body">
        
                  <div class="form-group">
                    <label>Pregunta</label>
                    <textarea rows="2" class="form-control textareaReadOnly" name="question" ng-model="faqCrud.question" readonly></textarea>
                  </div>
                  <div class="form-group">
                    <label>Respuesta</label>
                    <textarea rows="4" class="form-control textareaReadOnly" name="answer" ng-model="faqCrud.answer" readonly></textarea>
                  </div>
                
              </div>
              <div class="modal-footer">
                <form ng-submit = "deleteFaq(faqCrud.id)">
                    <?php echo e(csrf_field()); ?>

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
                <h5 class="modal-title">Pregunta Frecuente</h5>
            </div>
              <div class="modal-body">
        
                  <div class="form-group">
                    <label>Pregunta</label>
                    <textarea rows="2" class="form-control textareaReadOnly" name="question" ng-model="faqCrud.question" readonly></textarea>
                  </div>
                  <div class="form-group">
                    <label>Respuesta</label>
                    <textarea rows="4" class="form-control textareaReadOnly" name="answer" ng-model="faqCrud.answer" readonly></textarea>
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
                <h5 class="modal-title">Actualizar Pregunta Frecuente</h5>
              </div>
              <div class="modal-body">
                <form ng-submit="UpdateFaq()">
                  <div class="form-group">
                    <label>Pregunta</label>
                    <textarea rows="2" class="form-control" name="question"  ng-model="faqCrud.question" required ></textarea>
                  </div>
                  <div class="form-group">
                    <label>Respuesta</label>
                    <textarea rows="4" class="form-control" name="answer" ng-model="faqCrud.answer" required></textarea>
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

