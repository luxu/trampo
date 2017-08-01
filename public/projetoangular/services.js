'use strict'

angular.module('myApp.services',['ngResource'])
    .factory('TrampoSrv', ['$resource',
            function($resource) {
                return $resource(
                    '/api/trampo/:id', {
                        id: '@id'
                    },
                    {
                        update: {
                            method: 'PUT',
                            url: '/api/trampo/:id/'
                        }
                    }
                );
            }]
        )
    .factory('PecasSrv', ['$resource',
            function($resource) {
                return $resource(
                    '/api/pecas/:id', {
                        id: '@id'
                    },
                    {
                        update: {
                            method: 'PUT',
                            url: '/api/pecas/:id/'
                        }
                    }
                );
            }]
        )
    .factory('ItensPecasSrv', ['$resource',
            function($resource) {
                return $resource(
                    '/api/itenspecas/:id', {
                        id: '@id'
                    },
                    {
                        update: {
                            method: 'PUT',
                            url: '/api/itenspecas/:id/'
                        }
                    }
                );
            }]
        );