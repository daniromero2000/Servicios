var app =  angular.module('simulatorApp',['ngRoute', 'moment-picker','multipleSelect','ngMaterial']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/parametros', { templateUrl: 'simulador/parametros',controller: 'simulatorController' })
            .when('/pagaduria',{templateUrl:'simulador/pagaduria',controller:'pagaduriaController'})
            .otherwise({ redirectTo: '/parametros' })
}]);    
