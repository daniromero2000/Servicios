var app =  angular.module('simulatorApp',['ngRoute', 'moment-picker','multipleSelect','ngMaterial']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/parametros', { templateUrl: '/Administrator/simulador/parametros',controller: 'simulatorController' })
            .when('/pagaduria',{templateUrl:'/Administrator/simulador/pagaduria',controller:'pagaduriaController'})
            .otherwise({ redirectTo: '/parametros' })
}]);    
