	/**
     /Project: SERVICIOS FINANCIEROS
    **Case of Use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: union with warranty route
    **Date: 05/03/2019
     **/
var app =  angular.module('WarrantyApp',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'digitalWarranty/Query', controller:'warrantyController' })

            .otherwise({ redirectTo: '/' })
}]);