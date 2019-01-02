var app =  angular.module('usersApp',['ngRoute', 'moment-picker','angucomplete-alt']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'adminUsers/users',controller: 'userController' })
}]);
