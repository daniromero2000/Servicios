var app =  angular.module('catalogApp',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/Products', { templateUrl: '/Administrator/Catalog/Products',controller: 'productsController' })
            .when('/Lines', { templateUrl: '/Administrator/Catalog/Lines',controller: 'linesController' })
            .when('/Brands', { templateUrl: '/Administrator/Catalog/Brands',controller: 'brandsController' })

            .otherwise({ redirectTo: '/Products' })
}]);