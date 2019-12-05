var app =  angular.module('leadsApp',['ngRoute', 'moment-picker', 'ngBootbox']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'canalDigital/leads',controller: 'leadsController' })
}]);
