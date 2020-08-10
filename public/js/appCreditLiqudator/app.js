var app = angular.module('appCreditLiqudator', ['ngRoute', 'angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput']);
app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/', { templateUrl: 'creditLiquidator/index', controller: 'productListController' })
    }]);
