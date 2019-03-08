var app =  angular.module('appLibranzaLiquidador',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: '/libranza-principal/libranza-lines',controller: 'libranzaLiquidadorCtrl' })
}]);
