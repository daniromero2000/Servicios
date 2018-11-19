var app =  angular.module('fabricaLeadsApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'fabricaLeads/leads',controller: 'fabricaLeadsController' })
}]);
