var app =  angular.module('creditPolicyApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'adminCreditPolicy/creditPolicy',controller: 'creditPolicyController' })
}]);
