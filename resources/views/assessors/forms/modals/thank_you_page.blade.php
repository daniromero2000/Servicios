 <div class="modal fade hide modalThankYouPage-asessors" data-backdrop="static" data-keyboard="false" id="decisionCredit" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable modalCode">
         <div class="modal-content">
             <div class="modal-body" style="padding: 0">
                 <div class="row resetRow">
                     <div class="col-12 text-center resetCol headThankYuoModal">
                         <img src="{{ asset('images/asessors/logoModal.png') }}" alt="" class="img-fluid">
                     </div>
                     <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                     <div class="col-12" ng-if="resp.resp == 'true'">
                         <h2 class="decisionCredit-title text-center">Selecciona una opción</h2>
                         <div class="row my-4">
                             <div class="col-12 col-sm-6 text-center my-4" ng-if="resp.policy.ID_DEF == 26">
                                 <button class="decisionCredit-option" ng-disabled="resp.policy.ID_DEF == 26" ng-class="{'decisionCredit-selected': decisionCredit == 1}" ng-click="changeDesicionCredit(1)" style=" border: 0; ">
                                     <p>Tarjeta</p>
                                     <i class="fas fa-credit-card decisionCredit-option-icon"></i>
                                     <p class="mb-2">
                                         Tarjeta Bloqueda
                                     </p>
                                 </button>
                             </div>
                             <div class="col-12 col-sm-6 text-center my-4" ng-if="resp.policy.ID_DEF == '25'">
                                 <button class="decisionCredit-option" ng-class="{'decisionCredit-selected': decisionCredit == 3}" ng-click="changeDesicionCredit(3)" style=" border: 0; ">
                                     <i class="fas fa-credit-card decisionCredit-option-icon"></i>
                                     <p class="my-2 small">
                                         Ya cuentas con una tarjeta. <br>
                                         puedes continuar con tu tarjeta
                                     </p>
                                     <a type="button" class="btn btn-default text-dark">Click aquí</a>
                                 </button>
                             </div>
                             <div class="col-12 col-sm-6 text-center my-4" ng-if="resp.policy.ID_DEF != 25 && resp.policy.ID_DEF != 26">
                                 <button class="decisionCredit-option" ng-class="{'decisionCredit-selected': decisionCredit == 1}" ng-click="changeDesicionCredit(1)" style=" border: 0; ">
                                     <p>@{{ resp.infoLead.TARJETA }}</p>
                                     <i class="fas fa-credit-card decisionCredit-option-icon"></i>
                                     <p class="mb-0">
                                         Cupo Compras : $ @{{ resp.quotaApprovedProduct | number:0 }} <br>
                                         Cupo Avance : $ @{{ resp.quotaApprovedAdvance | number:0 }}
                                     </p>
                                     <a type="button" class="btn btn-default text-dark">Click aquí</a>
                                 </button>
                             </div>
                             <div class="col-12 col-sm-6 text-center my-4">
                                 <div class="decisionCredit-option" ng-class="{'decisionCredit-selected': decisionCredit == 2}" ng-click="changeDesicionCredit(2)">
                                     <p>Crédito Tradicional</p>
                                     <i class="fas fa-money-bill-wave decisionCredit-option-icon"></i>
                                     <p class="mb-0" style="font-style:italic; margin-top: 11px">
                                         * Aprobado sin codeudor
                                     </p>
                                     <p class="decisionCredit-textOption">
                                         <button type="button" class="btn btn-default">Click aquí</button>
                                     </p>
                                 </div>
                             </div>
                             <div class="col-12 text-center">
                                 <button class="btn btn-primary" ng-click="sendDecisionCredit()" ng-disabled="decisionCredit == '' || disabledDecisionCredit">Continuar</button>
                                 <button class="btn btn-danger" ng-click="desistCredit()" ng-disabled="disabledDecisionCredit">Desistir</button>
                             </div>
                         </div>
                     </div>
                     <div class="col-12" ng-if="resp.resp == '-2'">
                         <h2 class="decisionCredit-title text-center">Selecciona una opciòn</h2>
                         <div class="row my-4">
                             <div class="col-12 text-center my-4">
                                 <div class="decisionCredit-option" ng-class="{'decisionCredit-selected': decisionCredit == 2}" ng-click="changeDesicionCredit(2)">
                                     <p>Crédito Tradicional</p>
                                     <i class="fas fa-money-bill-wave decisionCredit-option-icon"></i>
                                     <p class="mb-0">
                                         Preaprobado <br>
                                         * <span style="font-style:italic; font-size:13px">@{{ resp.infoLead.DESCRIPCION }}</span>
                                     </p>
                                     <p class="decisionCredit-textOption">
                                         <button type="button" class="btn btn-default">Click aquí</button>
                                     </p>
                                 </div>
                             </div>
                             <div class="col-12 text-center">
                                 <button class="btn btn-primary" ng-click="sendDecisionCredit()" ng-disabled="decisionCredit == '' || disabledDecisionCredit">Continuar</button>
                                 <button class="btn btn-danger" ng-click="desistCredit()" ng-disabled="disabledDecisionCredit">Desistir</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
