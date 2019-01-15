var app =  angular.module('catalogApp',['ngRoute', 'ngBootbox','flow','ui.sortable']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/Products', { templateUrl: '/Administrator/Catalog/Products',controller: 'productsController' })
            .when('/Products/:id_product', { templateUrl: '/Administrator/Catalog/edtProduct',controller: 'productsEdtController' })

            .when('/Lines', { templateUrl: '/Administrator/Catalog/Lines',controller: 'linesController' })
            .when('/Brands', { templateUrl: '/Administrator/Catalog/Brands',controller: 'brandsController' })

            .otherwise({ redirectTo: '/Products' })
}]);