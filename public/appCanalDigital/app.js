var app =  angular.module('leadsApp',['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'canalDigital/leads',controller: 'leadsController' })
}]);
