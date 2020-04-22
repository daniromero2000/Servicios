
var app = angular.module('ProductListApp', ['ngRoute']);
app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'ProductList/admin', controller: 'Controller' })
    }]);
