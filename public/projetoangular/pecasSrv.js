'use strict'

angular.module('pecas',['ngResource'])
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
	    );