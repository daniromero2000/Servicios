	/**
     /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO PRODUCTS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: relacion con la ruta a usuarse en esta app
    **Fecha: 19/12/2018
     **/
var app =  angular.module('LineApp',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'Lines/admin',controller:'Controller' })
}]);
