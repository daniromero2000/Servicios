var app =  angular.module('customersApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: '/solicitudesAsessores/clientes',controller: 'customersAssessorsController' })
}]);