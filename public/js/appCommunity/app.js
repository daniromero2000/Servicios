var app =  angular.module('campaignsApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'community/campaigns',controller: 'campaignsController' })
}]);