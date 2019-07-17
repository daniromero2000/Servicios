var app =  angular.module('creditPolicyApp',['ngRoute', 'moment-picker', 'ngBootbox', 'ngMaterial']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
        when('/creditPolicy', { templateUrl: '/Administrator/AdminCreditPolicy/creditPolicy',controller: 'creditPolicyController' })

        .otherwise({ redirectTo: '/creditPolicy' })
}]);