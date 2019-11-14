var app =  angular.module('directorApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'director/leads',
                controller: 'directorController'
            })
}]);
