var app =  angular.module('usersApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'adminUsers/users',controller: 'userController' })
}]);
