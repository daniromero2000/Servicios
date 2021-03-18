 <div class="modal fade hide" data-backdrop="static" data-keyboard="false" id="confirmCodeVerification" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modalCode">
         <div class="modal-content">
             <div class="modal-body" style="padding: 10px">
                 <form ng-submit="verificationCode()">
                     <div class="row">
                         <div class="col-12 form-group">
                             <label for="">Código de Verificacion</label>
                             <input type="text" ng-model="code.code" class="form-control" required />
                         </div>
                         <div class="col-12 text-center form-group">
                             <button class="btn btn-primary" ng-disabled="disabledButtonCode">Confirmar
                                 Código</button>
                             <button type="button" ng-show="reNewToken" class="btn btn-warning" ng-click="getCodeVerification(true)">Generar Nuevo Código</button>

                             <p ng-show="reSend" class="alert alert-success mt-4 mb-0">El token fue re enviado automaticanmente</p>

                             <p ng-show="reSend" class="alert alert-success mt-4 mb-0">El token fue enviado al correo del director, por favor verificar</p>

                         </div>
                         <div class="col-12 text-center" ng-show="showAlertCode">
                             <div class="alert alert-danger" role="alert">
                                 Código erróneo, por favor verifícalo
                             </div>
                         </div>
                         <div class="col-12 text-center" ng-show="showWarningCode">
                             <div class="alert alert-warning" role="alert">
                                 El código ya expiró, <span class="renewCode" ng-click="getCodeVerification(true)">clic aquí</span> para generar un nuevo
                                 código
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
