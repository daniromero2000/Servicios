var app =  angular.module('appLibranzaLiquidador',['ngRoute','moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: '/libranza-principal/libranza-lines',controller: 'libranzaLiquidadorCtrl' })
}]);
