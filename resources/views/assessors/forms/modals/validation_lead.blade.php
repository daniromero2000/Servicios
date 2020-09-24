 <div class="modal modalCardExist fade hide" data-backdrop="static" data-keyboard="false" id="validationLead" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content modalCardContent">
             <div class="modal-body modalStepsBody " style="padding: 0">
                 <div class="row resetRow">
                     <div class="col-12 text-center containerLogoModalStep">
                         <img src="{{ asset('images/logoOportuyaModalStep.png') }}" alt="" class="img-fluid">
                     </div>
                 </div>
                 <div class="row resetRow">
                     <div class="col-12">
                         <p class="textModal text-center">
                             <strong>Gracias</strong> por contar con nosotros
                         </p>
                         <br>
                         <br>
                         <div class="row">
                             <div class="offset-4 offset-sm-4 col-sm-8 mt-5 offset-ld-1 col-8 text-center">
                                 <p ng-bind-html="messageValidationLead">
                                 </p>
                                 <div class="text-center">
                                     <a class="btn btn-danger buttonBackCardExist" href="/Administrator/crearCliente">Regresar</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row resetRow containerFormModal">
                     <div class="col-sm-7 offset-sm-5">

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
