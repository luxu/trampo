'use strict'

angular.module('myApp',
    [
    'ngRoute',
    'Veiculo',
    'Pecas',
    'Trampo',
    'ItensPecas',
    'Login',
    // 'kendo.directives'
    ])
    .config(['$routeProvider','$locationProvider', function($routeProvider,$locationProvider) {
             $locationProvider.hashPrefix(''),
             $routeProvider
                 .when('/', {
                     templateUrl: 'projetoangular/templates/index.html'
                 })
                 .otherwise({
                   redirectTo: '/'
                 })
            }
        ]
    );