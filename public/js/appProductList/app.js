
var app = angular.module('productListApp', ['ngRoute', 'angucomplete-alt', 'flow']);
app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/', { templateUrl: 'ProductList/admin', controller: 'productListController' })
    }]);
