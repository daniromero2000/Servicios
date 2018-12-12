	/**
     /Proyecto: SERVISIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: relacion con la ruta a usuarse en esta app
    **Fecha: 12/12/2018
     **/
var app =  angular.module('FaqsApp',['ngRoute', 'moment-picker']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', { templateUrl: 'preguntasFrecuentes/admin',controller:'Controller' })
}]);
