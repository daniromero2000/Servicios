var app =  angular.module('creditPolicyApp',['ngRoute', 'moment-picker', 'ngBootbox']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
        when('/creditPolicy', { templateUrl: '/Administrator/AdminCreditPolicy/creditPolicy',controller: 'creditPolicyController' })
        .when('/creditPolicy/:id_creditPolicy', { templateUrl: '/Administrator/AdminCreditPolicy/edtCreditPolicy',controller: 'edtCreditPolicyController' })

        .otherwise({ redirectTo: '/creditPolicy' })
}]);