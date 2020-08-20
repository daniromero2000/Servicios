var app = angular.module('appQuotations', ['ngRoute', 'angucomplete-alt', 'flow', 'moment-picker', 'ng-currency', 'ngSanitize', 'ngTagsInput']);
app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/', { templateUrl: 'assessorquotations/index', controller: 'AssesorQuotationController' })
    }]);
