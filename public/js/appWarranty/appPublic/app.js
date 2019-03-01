	/**
     /Proyect: SERVICIOS FINANCIEROS
    **Case of Use: MODULO PRODUCTS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: relacion con la ruta a catalog en esta app
    **Date: 21/12/2018
     **/
var app =  angular.module('WarrantyApp',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'digitalWarranty/Query',controller:'warrantyController' })
}]);