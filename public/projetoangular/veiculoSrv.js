'use strict'

angular.module('veiculo',['ngResource'])
	.factory('VeiculoSrv', ['$resource',
	        function($resource) {
	            return $resource(
	                '/api/veiculo/:id', {
	                    id: '@id'
	                },
	                {
	                    update: {
	                        method: 'PUT',
	                        url: '/api/veiculo/:id/'
	                    }
	                }
	            );
	        }]
	    );