var app =  angular.module('directorApp',['ngRoute', 'moment-picker', 'ngBootbox']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'director/leads',
                controller: 'DirectorController'
            })
}]);
