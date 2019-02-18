/**
    /Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULOS
    **Autor: Juan Sebastian Ormaza
    **Email: desarrollo@lagobo.com
    **Descripción: relacion con la ruta a usuarse en esta app
    **Fecha: 04/02/2019
**/
var app =  angular.module('modulesApp',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/Modules', { templateUrl: '/Administrator/Modules/Modules',controller:'modulesController' })

            .otherwise({ redirectTo: '/Modules' })
}]);
