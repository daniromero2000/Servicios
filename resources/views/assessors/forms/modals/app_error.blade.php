 <div class="modal fade bd-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog" id="error" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-body " style="padding: 0">
                 <div class="row">
                     <div class="col-12 col-lg-4">
                         <div>
                             <img src="{{ asset('images/error.gif')}}" class="img-fluid">
                         </div>
                     </div>
                     <div class="col-12 col-lg-8">
                         <div class="error-content p-3">
                             <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! El aplicativo a
                                 presentado un
                                 error.</h3>
                             <div>
                                 <p style="margin: 0px;">
                                     Puedes comunicate con el area de desarrollo y darle este número de error<strong style="font-size:20px; color: #1b8acc">@{{ numError }}</strong>.
                                 </p>
                                 <p class="text-right m-0">
                                     <a href="/Administrator/crearCliente" class="btn  btn-primary btn-sm">Regresar</a>

                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
