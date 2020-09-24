  <div class="modal fade hide" data-backdrop="static" data-keyboard="false" id="confronta" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modalConfronta">
          <div class="modal-content">
              <div class="modal-body" style="padding: 0 30px">
                  <h2 class="text-center confronta-title">Preguntas de Seguridad</h2>
                  <form ng-submit="sendConfronta()">
                      <div class="col-12 form-group" ng-repeat="pregunta in formConfronta">
                          <p>@{{ pregunta.pregunta }}</p>
                          <div ng-repeat="opcion in pregunta.opciones">
                              <input type="radio" name="@{{ pregunta.secuencia }}" ng-model="pregunta.opcion" class="form-group" id="@{{ opcion.secuencia_resp }}" ng-value="opcion.secuencia_resp"><label class="confronta-label" for="@{{ opcion.secuencia_resp }}">@{{ opcion.opcion }}</label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-12 text-center">
                              <button type="submit" class="btn btn-primary">Enviar</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
