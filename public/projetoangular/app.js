'use strict'

angular.module('myApp',
    [
    'ngRoute',
    'Veiculo',
    'Pecas',
    'Trampo',
    'ItensPecas',
    'Rotas',
    'Login',
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