	/**
     /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO PRODUCTS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: relacion con la ruta a usuarse en esta app
    **Fecha: 12/12/2018
     **/
var app =  angular.module('BrandApp',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'Brands/admin',controller:'Controller' })
}]);