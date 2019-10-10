@php 
// {{asset('images/libranza/libre-inversion-image.png')}}
 @endphp
{!! NoCaptcha::renderJs() !!}
<br>
<br>
<div id="simulador-header">
    <div>
        <div class="row">
            <div class="col-12 col-sm-12 libranza-top">
                <img src="{{asset('images/libranza/top.jpg')}}" alt="" class="img-fluid">
            </div>
            {{-- <div class="content-text-slider">
                <h1 class="title-btnslider">Negocios Synergy via<br>Robust Strategies</h1>
                <span class="text-slider">
                    Lorem ipsum is simply dymmy text of the<br>
                    printing and typesetting has been teh industrys<br>
                    standard dummy text
                </span>
                <div class="content-buton">
                    <a class="buton-slider" href="">¡Click aquí!</a>
                </div>
            </div> --}}
        </div>
        <div class="row content-butons">
            <div class="col-12 col-sm-6 content-buton1 mt-butons">
                <a class="buton-cart" ng-click="showAdvanced($event)" href="" alt="" class="button-cart"><img class="img-but"src="{{asset('images/libranza/icon1.png')}}" alt="" class="img-fluid">Compra de Cartera</a>
            </div>
            <div class="col-12 col-sm-5 content-buton2 mt-butons">
                <a class="buton-cred" ng-click="showAdvancedLI($event)" href="" alt="" class="buton-cart"><img class="img-but"src="{{asset('images/libranza/icon2.png')}}" alt="" class="img-fluid">Crédito de Libre Inversión</a>
            </div>        
        </div>
    </div>
</div>
<br>
<div id="sliderPrincipalLibranza">
    <div class="row resetRow">
    </div>
    <div class="row resetRow">
    </div>
    <div class="form-simulator-containernew resetRow">
        <div class="tittle-formsimulator">
            <span class="tittle-formsimulator">SIMULADOR DE CRÉDITO</span>
            <p class="description-formsimulator">Crédito de libranza, para lo que necesites, con plazos<br>hasta 120 meses y montos hasta $80,000,000<br><span class="text-report"><span class=""><span class="color-red">¿</span><span>Estás </span><span class="color-red">reportado</span><span class="color-red">?, </span></span><span>te damos una<br>segunda oportunidad<span class="color-red">!</span></span></p>
            <img class="line-log"src="{{asset('images/libranza/linelogo.png')}}" alt="" class="img-fluid">
        </div>
        <div class="row h-100  form-simulator-max-width">
            <div class="offset-xl-1 col-xl-4 col-md-8 offset-md-2 offset-lg-0 col-lg-5 bg-simulator text-center position-relative radius-form">
                <div class="row">
                
                        <div class="container-titleform1 bg-primary">
                                <h3 class=" font-weight-bold pt-3 pb-2 font-title-form">¿Cuánto dinero necesitas?</h3>
                        </div>
                    <div class="offset-1 offset-lg-1 col-10 col-lg-10 p-0">
                        <div class="form-simulator ">
                            <form action="">        
                                <div class="form-group">
                                    <br>
                                    <br>
                                    <rzslider  ng-click="sumCLicks()" ng-change="simular(0)" ng-model="sliderAmount.value" rz-slider-model="sliderAmount.value" z-slider-high="maxAmount" rz-slider-options="sliderAmount.options"></rzslider>
                                </div>
                                <div class="form-group font-white">
                                    <label for="timeLimit">¿Cuánto tiempo necesitas para pagar?</label>
                                    <br> 
                                    <rzslider ng-click="sumCLicks()" ng-change="simular(2)" ng-model="sliderTime.value" rz-slider-model="sliderTime.value" rz-slider-options="sliderTime.options"></rzslider>
                                </div>
                                <div class="form-group">
                                    <label for="timeLimit">¿Cuál es tu puntaje de crédito?</label>
                                    <br>
                                    <rzslider ng-click="sumCLicks()" ng-model="sliderRate.value" rz-slider-model="sliderRate.value" rz-slider-options="sliderRate.options"></rzslider>
                                </div>
                            </form>
                            <br>
                            <br>
                            <br>
                            <div class="row" ng-show="!showAlertError">
                                <div class="col-12 col-sm-6">
                                    <div class="buton-plazo-monto">
                                        <p class="font-weight-bold">Plazo: <span class="font-weight-initial">@{{valueTime}} Meses</span></p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="buton-plazo-monto">
                                        <p class="monto font-weight-bold">Monto: <span class="font-weight-initial">$ @{{sliderAmount.value|number:0}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row position-absolute fixed-bottom resetRow color-white info-rate-bottom">
                    <div class="col-7 info-rate-interest">
                        <p>Tasa de interés</p>
                        <span class="font-weight-bold">@{{interest}} %</span>
                    </div>
                    <div class="col-5 info-rate-quota resetCol color-blue">
                        <p>Cuota fija mensual</p>
                        <span class="font-weight-bold">$ @{{basicFee|number:0}}</span>
                    </div>
                </div>    
            </div>
            <div class="offset-xl-1 col-xl-5 col-md-8 offset-md-2 offset-lg-1 col-lg-6 form-simulator-header bg-simulator text-center h-100">
                <div class="row text-center">
                    <div class="container-titleform1 bg-primary">
                        <h3 class="font-weight-bold pt-3 pb-2 font-title-form">Calcula tu crédito</h3>
                    </div>
                </div>
                <div class="row" data-toggle="tooltip" id="form-body-simulator" ng-class="classForm" ng-model="classForm">
                    <div class="offset-1 offset-lg-1 col-10 col-lg-10 p-0">
                        <div class="form-simulator">
                            <form ng-submit="showModal()" name="myForm">
                                @csrf
                                <div layout="row">
                                    <md-input-container flex="100" class="text-left backinput">
                                        <label class="formularioSimulador-labelFormulario" for="creditLine">Linea de Crédito </label>
                                        <md-select ng-disabled="inputDisable" name="type" ng-model="libranza.creditLine" required="" ng-change="ableField()">
                                            <md-option ng-value="linea.id" ng-repeat="linea in lines">@{{linea.name}}</md-option required>
                                        </md-select>
                                    </md-input-container>
                                </div>
                                <div layout="row">
                                    <md-input-container flex="100" class="text-left backinput">
                                        <label class="formularioSimulador-labelFormulario mt-4" for="crecustomerTypeditLine">Tipo de cliente </label>
                                        <md-select ng-disabled="inputDisable" name="type" ng-model="libranza.customerType" required="" ng-change="selectPagaduria()">
                                            <md-option ng-value="tipo.id" ng-repeat="tipo in libranzaProfiles">@{{tipo.name}}</md-option required>
                                        </md-select>
                                    </md-input-container>
                                </div>
                                <div layout="row" layout-xs="column">  
                                    <md-input-container flex-gt-xs="100" flex-gt-md="50" class="m-0">
                                        <label class="text-left w-100">Fecha de nacimiento</label>
                                        <md-datepicker class="" ng-disabled="inputDisable" ng-model="birthday" ng-blur="calculateAge(birthday)" md-current-view="year"></md-datepicker>
                                        <p class="m-0 format-date-label"><span class="color-white small text-center">Año/Mes/Día</span></p>
                                    </md-input-container>
                                    <md-input-container flex-gt-xs="100" flex-gt-sm="50" class="text-left m-0 backinput">
                                        <label for="birthday">Pagaduría</label>
                                        <md-select ng-disabled="inputDisable" name="type" ng-model="libranza.pagaduria" required="true">
                                            <md-option ng-value="pagaduriaItem.idPagaduria" ng-repeat="pagaduriaItem in pagaduriaLibranza">@{{pagaduriaItem.name}}</md-option required>
                                        </md-select>
                                    </md-input-container>
                                </div>
                                <div layout="row" layout-xs="column" uib-tooltip="Some text">  
                                    <md-input-container flex-gt-xs="100" layout-gt-sm="50" class="text-left backinput">
                                        <label>Salario básico</label>
                                        <input type="text" ng-disabled="inputDisable" id="salary" class="form-control" ng-currency fraction="0" min="0" validation-pattern="number" ng-model="libranza.salary" ng-blur="simulate()" required>
                                    </md-input-container>
                                    <md-input-container flex-gt-xs="100" layout-gt-sm="50" class="text-left ">
                                        <label>Descuentos de ley</label>
                                        <input  type="text" id="lawDesc" class="form-control backinput" ng-currency fraction="0" min="0" validation-pattern="number" ng-model="libranza.lawDesc" ng-disabled="true" required>
                                    </md-input-container>
                                </div> 
                                <div layout="row"  ng-if="!quotaBuy">  
                                    <md-input-container flex="100" class="text-left">
                                        <label>Otros Descuentos</label>
                                        <input ng-disabled="inputDisable" type="text" id="otherDesc" class="form-control backinput" ng-model="libranza.otherDesc" ng-currency fraction="0" min="0" validation-pattern="number" ng-blur="simulate()" ng-change="validateInt()" required>
                                    </md-input-container>
                                </div> 
                                <div layout="row"  ng-if="quotaBuy">  
                                    <md-input-container flex="50" class="text-left backinput">
                                        <label>Otros Descuentos</label>
                                        <input  ng-disabled="inputDisable" type="number" id="otherDesc" class="form-control" ng-model="libranza.otherDesc" validation-pattern="number" ng-blur="simulate()" ng-change="validateInt()" required>
                                    </md-input-container>
                                    <md-input-container flex="50" class="text-left">
                                        <label>Valor Cuota Compra</label>
                                        <input ng-disabled="inputDisable" type="text" validation-pattern="number" id="quotaBuy" class="form-control" ng-model="libranza.quotaBuy" ng-blur="simulate()" ng-change="validateInt()" required>
                                    </md-input-container>
                                </div>
                                <div class="row" ng-show="showAlertError">
                                    <div class="w-100 alert alert-danger" role="alert">
                                        Por favor verifica la información ingresada o comunícate con nosotros para asesorarte
                                    </div>  
                                </div>
                                <div class="row">
                                    <p class="color-blue">
                                        Si deseas un mayor cupo, puedes aumentar el plazo de tu crédito, la cuota no varia y es fija por el plazo del crédito
                                    </p>
                                </div>
                                <div class="formularioSimulador-containInput text-center">
                                        <button type="submit" ng-disabled="inputDisableButton" class="btn buttonSend formularioSimulador-buttonForm" style="margin-top: 15px;">Cotiza tu crédito</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>  
</div>
<div class="modal modalFormulario fade hide" id="solicitarModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modalFormulario-body">
                <div class="modal-containerFormulario">
                    <div class="formularioSimulador-containerFormulario"    >
                        <h3 class="formularioSimulador-titleForm font-weight-bold">
                            Déjanos tus datos
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;       </button>
                        </h3>
                        <div class="containerFormulario">
                            <form ng-submit="addLead()" id="formEx">
                                <input type="hidden" ng.model="libranza.typeService" value="libranza">
                                <input type="hidden" ng.model="libranza.channel" value="1">
                                <div layout="row">  
                                    <md-input-container flex="" class="text-left">
                                        <label>Número de identificación</label>
                                        <input type="number" id="identificationNumber" class="form-control" ng-model="libranza.identificationNumber" validation-pattern="number">
                                    </md-input-container>
                                </div>
                                <div layout="row">  
                                    <md-input-container flex="" class="text-left">
                                        <label>Nombres</label>
                                        <input id="nameInput" type="text" ng-model="libranza.name" class="form-control" id="name" validation-pattern="name" required="true">
                                    </md-input-container>
                                </div>

                                <div layout="row">  
                                    <md-input-container flex="" class="text-left">
                                        <label>Apellidos</label>
                                        <input type="text" ng-model="libranza.lastName" class="form-control" id="lastName" validation-pattern="name">
                                    </md-input-container>
                                </div>
                                <div layout="row">  
                                    <md-input-container flex="" class="text-left">
                                        <label>Correo electrónico</label>
                                        <input type="email" ng-model="libranza.email" class="form-control" id="email" validation-pattern="email" required="true">
                                    </md-input-container>
                                </div>
                                <div layout="row">  
                                    <md-input-container flex="" class="text-left">
                                        <label>Teléfono</label>
                                        <input type="text" ng-model="libranza.telephone" class="form-control" id="telephone" validation-pattern="telephone" required="true">
                                    </md-input-container>
                                </div>
                                <div layout="row">  
                                    <md-input-container flex="" class="text-left">
                                    <label class="formularioSimulador-labelFormulario">Ciudad </label>
                                        <md-select name="city" ng-model="libranza.city" required="">
                                            <md-option ng-value="city.city" ng-repeat="city in cities">@{{city.city}}</md-option>
                                        </md-select>
                                    </md-input-container>
                                </div>
                                <br>
                                <div class="w-100 text-center">
                                   <!-- {!! NoCaptcha::display(['data-callback' => 'enableBtn']) !!}-->
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" ng-model="libranza.termsAndConditions" id="termsAndConditions" ng-true-value="1" ng-false-value="0" required>
                                    <label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
                                        Aceptar <a href="/Terminos-y-condiciones-simulador" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
                                    </label>
                                </div>
                                <p class="textCityForm">
                                    *Válido solo para ciudades que se desplieguen en la casilla.
                                </p>
                                <div class="formularioSimulador-containInput text-center">
                                    <button type="submit" id="button1" class="btn buttonSend formularioSimulador-buttonForm" style="margin-top: 15px;">Siguiente</button>
                                </div>
                            </form>
                        </div>
                    </div>                     
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // document.getElementById("button1").disabled = true;
    // function enableBtn(){
    //     document.getElementById("button1").disabled = false;
    // }
</script>
