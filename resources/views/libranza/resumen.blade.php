<div class="w-75 m-auto">
    <div class="row resumen-header mt-5">
        <div class="col-6">
            <div class="w-100 text-center">
                <img src="{{asset('images/logo-oportunidades-libranza.png')}}" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-6">
            <div class="w-100 text-center">
                <img src="{{asset('images/logoCreoBanner.png')}}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <br>
    <div class="row text-center">
        <h3 class="w-100 display-4 font-weight-bold">
            ¡@{{leadResumen.name}} @{{leadResumen.lastName}}, felicitaciones <br> te falta muy poco para <br> obtener tu crédito!
        </h3>
    </div>
    <br>
    <div class="row">
        <div class="w-50 m-auto">
            <div class="row h2 max-w-6">
                <div class="col-6">
                    <p class="color-red">
                        Monto:
                    </p>
                </div>
                <div class="col-6">
                    <p class="resumen-item">
                    $ @{{leadResumen.amount|number:0}}
                    </p>
                </div>
            </div>
            <div class="row h2 max-w-6">
                <div class="col-6">
                    <p class="color-red">
                        Plazo:
                    </p>
                </div>
                <div class="col-6">
                    <p class="resumen-item">
                        @{{leadResumen.timeLimit}} Meses
                    </p>
                </div>
            </div>
            <div class="row h2 max-w-6">
                <div class="col-6">
                    <p class="color-red">
                        Cuota:
                    </p>        
                </div>
                <div class="col-6">
                    <p class="resumen-item">
                        $ @{{leadResumen.fee|number:0}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row contact-resumen text-center">
        <p class="text-center w-100">Espera nuestra llamada, nos pondremos en contacto en un máximo 24 horas hábiles para confirmarte la preaprobación</p>
    </div>
    <br>
    <br>
    <div class="row digital-copy-resumen fs-24 color-black resetRow">
        <p>Si tienes copia digital de los siguientes documentos, podrás adjuntarlos en línea o remitirlos al correo <span class="font-weight-bold">asesorvirtual@creolibranzas.com</span></p>
    </div>
    <div class="row files-resumen fs-24 color-black resetRow">
        <ul>
            <li>
                <p>Último desprendible de pago de nómina 
                    <input ng-disabled="disableFileButton" type="file" ng-files="setTheFiles($files)" id="image_file"  class="form-control">
                    <button  ng-click="uploadFile(this)" ng-show="hideButton" class="btn btn-primary">Subir archivo</button>
                    <span ng-show="successButton" class="success-color"><i class="fas fa-check-circle"></i></span>
                    <br>
                    <small class="small">El archivo cargado debe ser  en formato .png o .jpg y su tamaño máximo es de 50 KiloBytes</small>
                </p>
                <ul class="alert alert-danger" ng-if="errors.length > 0">
                    <li ng-repeat="error in errors">
                        @{{ error }}
                    </li>
                </ul>                
            </li>
            <li>
                <p>Copia cédula al 150%   
                    <input ng-disabled="disableDocumentButton" type="file" ng-files="setTheDocuments($files)" id="document_file"  class="form-control">
                    <button  ng-click="uploadDocument(this)" ng-show="hideButtonDocument" class="btn btn-primary">Subir archivo</button>
                    <span ng-show="successButtonDocument" class="success-color"><i class="fas fa-check-circle"></i></span>
                    <br>
                    <small class="small">El archivo cargado debe ser  en formato .png o .jpg y su tamaño máximo es de 50 KiloBytes</small>
                </p>
                <ul class="alert alert-danger" ng-if="errorsDocument.length > 0">
                    <li ng-repeat="error in errorsDocument">
                        @{{ error }}
                    </li>
                </ul>  
            </li>
        </ul>
    </div>
    <div class="row">
        <p class="text-center font-weight-bold">
            Los valores resultantes de esta simulación, son informativos, aproximados y podrán variar de acuerdo a las políticas de estudio y aprobación del crédito.
        </p>
    </div>
    <br>
   
    <div class="row">
        <p class="text-center w-100">
        <a href="/libranza">
            <button class="btn btn-primary">
                Volver a simular
            </button>
        </a>
        </p>
    </div>
    <br>
</div>