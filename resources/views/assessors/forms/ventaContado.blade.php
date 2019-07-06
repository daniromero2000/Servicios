@extends('layouts.app')
@section('title', 'Formulario venta de contado')

@section('metaTags')
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
@endsection()

@section('content')
    <div class="container" ng-app="asessorVentaContadoApp" ng-controller="asessorVentaContadoCtrl">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="forms-nameAssessor">
                    {{Auth::guard('assessor')->user()->NOMBRE}}
                </h3>
                <h4>
                    Formulario venta de contado
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form name="ventaContado">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label>Tipo de documento</label>
                                <md-select name="TIPO_DOC" ng-model="lead.TIPO_DOC" required>
                                    <md-option ng-repeat="type in typesDocuments" value="@{{type.value}}">@{{ type.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label>Número de identificación</label>
                                <input required name="CEDULA" ng-model="lead.CEDULA" validation-pattern="number">
                                <div ng-messages="ventaContado.CEDULA.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                    <div ng-message="pattern">Solo se permiten números.</div>
                                </div>
                            </md-input-container>
                        </div>
                        <div class="col-12 col-sm-4">
                            <md-input-container>
                                <label>Fecha expedición documento</label>
                                <md-datepicker required ng-model="lead.FEC_EXP" md-current-view="year"></md-datepicker>
                                <div ng-messages="ventaContado.FEC_EXP.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                </div>
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label>Nombres</label>
                                <input required name="NOMBRES" ng-model="lead.NOMBRES" validation-pattern="name">
                                <div ng-messages="ventaContado.NOMBRES.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                </div>
                            </md-input-container>
                        </div>
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label>Apellidos</label>
                                <input required name="APELLIDOS" ng-model="lead.APELLIDOS" validation-pattern="name">
                                <div ng-messages="ventaContado.APELLIDOS.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                </div>
                            </md-input-container>
                        </div>
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label>Email</label>
                                <input required name="EMAIL" ng-model="lead.EMAIL" validation-pattern="email">
                                <div ng-messages="ventaContado.EMAIL.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                </div>
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label>Celular</label>
                                <input required name="CELULAR" ng-model="lead.CELULAR" validation-pattern="telephone">
                                <div ng-messages="ventaContado.CELULAR.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                </div>
                            </md-input-container>
                        </div>
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label>Ocupación</label>
                                <md-select required name="ACTIVIDAD" ng-model="lead.ACTIVIDAD" required>
                                    <md-option ng-repeat="actividad in occupations" value="@{{actividad.value}}">@{{ actividad.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <div class="col-12 col-sm-4">
                            <md-input-container>
                                <label></label>
                            </md-input-container>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scriptsJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script type="text/javascript" src="{{ asset('js/assessorVentaContado.js') }}"></script>
@endsection