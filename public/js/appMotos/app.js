var app =  angular.module('motosApp',['ngRoute', 'moment-picker','flow']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: '/admin/motos/leads',controller: 'motosController' })
}]);
