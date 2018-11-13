var app =  angular.module('leadsApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'canalDigital/leads',controller: 'leadsController' })
}]);
