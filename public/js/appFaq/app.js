var app =  angular.module('FaqsApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'preguntasFrecuentes/admin',controller:'Controller' })
}]);
