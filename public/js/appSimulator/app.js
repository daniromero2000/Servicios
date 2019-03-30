var app =  angular.module('simulatorApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'simulador/admin',controller: 'simulatorController' })
}]);
