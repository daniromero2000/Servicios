var app =  angular.module('appLibranzaLiquidador',['ngRoute','moment-picker','ng-currency','ngMaterial','ngMessages','rzSlider'],['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
}]);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider
            //when('/', { templateUrl: '/libranza-principal/libranza-lines',controller: 'libranzaLiquidadorCtrl'})
            .when('/',{templateUrl:'/libranza-principal/simulador',controller:'libranzaLiquidadorCtrl'})
            .when('/solicitud/:idLeadParam',{templateUrl:'/libranza-principal/resumen',controller:'libranzaLiquidadorCtrl'})
}])
.config(function($mdDateLocaleProvider) {
    $mdDateLocaleProvider.months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    $mdDateLocaleProvider.shortMonths = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    $mdDateLocaleProvider.formatDate = function(date) {
       return moment(date).format('YYYY/MM/DD');
    };
}).config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);
