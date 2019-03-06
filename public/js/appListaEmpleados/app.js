var app =  angular.module('listaEmpleadosApp',['ngRoute', 'ngBootbox']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
        when('/ListaEmpleados', { templateUrl: '/Administrator/ListaEmpleados/ListaEmpleados', controller: 'listaEmpleadosController' })

        .otherwise({ redirectTo: '/ListaEmpleados' })
}]);