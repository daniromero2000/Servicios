
var app = angular.module('productListApp', ['ngRoute', 'angucomplete-alt']);
app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/', { templateUrl: 'ProductList/admin', controller: 'productListController' })
    }]);
