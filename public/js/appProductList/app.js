
var app = angular.module('productListApp', ['ngRoute', 'angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput']);
app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/', { templateUrl: 'ProductList/admin', controller: 'productListController' })
    }]);
