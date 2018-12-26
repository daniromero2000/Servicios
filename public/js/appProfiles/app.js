	/**
     /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO PRODUCTS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: relacion con la ruta a usuarse en esta app
    **Fecha: 21/12/2018
     **/
var app =  angular.module('ProfileApp',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'Profiles/admin',controller:'Controller' })
}]);
