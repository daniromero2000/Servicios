var app =  angular.module('communityLeadsApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'communityLeads/leads',controller: 'communityController' })
}]);
