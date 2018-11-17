var app =  angular.module('libranzaLeadsApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'libranzaLeads/leads',controller: 'libranzaLeadsController' })
}]);
