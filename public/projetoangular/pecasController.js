function PecasService($http) {
  const BASE_URL = '/api/pecas/';
  this.list = function() {
    const request = {
      url: BASE_URL,
      method: 'GET'
    }
    return $http(request);
  }

  this.novo = function(pecas) {
      const request = {
        url: BASE_URL,
        method: 'POST',
        data: pecas
      }
      return $http(request);
    }

  this.editar = function(pecas) {
      const request = {
        url: BASE_URL + 'editar/' + pecas.id,
        method: 'GET'
      }
      return $http(request);
    }

    this.remove = function(pecas) {
      const request = {
        url: BASE_URL + pecas.id,
        method: 'DELETE'
      }
      return $http(request);
    }

}

/*
dataservice.$inject = ['$http', 'logger'];

function dataservice($http, logger) {
    return {
        getAvengers: getAvengers
        id:46
    };

    function getAvengers() {
         return $http.get('/api/maa')
             .then(getAvengersComplete)
             .catch(getAvengersFailed);

         function getAvengersComplete(response) {
             return response.data.results;
         }

         function getAvengersFailed(error) {
             logger.error('XHR Failed for getAvengers.' + error.data);
         }
     }
}
*/

function PecasNovoController (PecasService) {
  var vm = this;
  ((PecasService) => {
      vm.submitForm = submitForm;
      // vm.tipoPecas = [];
      // vm.tipoPecas.push('Carro');
      // vm.tipoPecas.push('Moto');
      vm.tipoPecas = [
              {nome: 'Carro', apelido: 'carro', type: 'veiculos', active: true}
            , {nome: 'Moto', apelido: 'moto', type: 'veiculos', active: false}
      ];
      vm.veiculo = vm.tipoPecas[0];

      function submitForm(pecas) {
        console.log('submitForm', pecas);

        PecasService
        .novo(pecas)
        .then(
          function success(data) {
            console.log('Data: ', data.data);
            vm.cadastrado = data.data;
            },
            function fail(err) {
                console.log('Erro: ', err);
                vm.erro = err;
            });
      }
  })(PecasService);
}

function PecasEditarController($http, $routeParams) {
  var vm = this;
  vm.routeParams = 46; //$routeParams;
  vm.editing = false;
  vm.reverse = false;
  vm.tipoPecasEditar = [];
  vm.tipoPecasEditar.push('Carro');
  vm.tipoPecasEditar.push('Moto');
  // console.log('$routeParams: ' + vm.routeParams);

  // const url = '/api/pecas/editar/'+$routeParams.id;
  const url = '/api/pecas/46';
  const method = 'GET';
  $http({
    url: url,
    method: method
  })
  .then(
      function success(data) {
        console.log('Data: ', data.data);
        vm.pecas = data.data;
        vm.tipoPecasEditarSelecionada = data.data.veiculo;
      },
      function fail(err) {
        console.log('Erro - Editar: ', err);
      }
  );
/*
  (
      (PecasService) => {
          PecasService
          .editar(pecas)
          .then(
            function success(data) {
              console.log('Editar: ', data);
              vm.pecas = data;
            },
            function fail(err) {
              console.log('Erro: ', err);
              vm.erro = err;
            }
          );
      }
  )
  (PecasService);
  */
}
PecasController.$inject = ['$http', '$rootScope'];

function PecasDetailsController($http, $routeParams) {
  var vm = this;
  vm.routeParams = $routeParams;
  vm.editing = false;
  vm.reverse = false;
  vm.pecas = [];

  const url = '/api/pecas/'+$routeParams.id;
  const method = 'GET';
  $http({
    url: url,
    method: method
  })
  .then(
      function success(data) {
        console.log('Data: ', data.data);
        vm.pecas = data.data;
      },
      function fail(err) {
        console.log('Erro: ', err);
      }
  );
}
PecasController.$inject = ['$http', '$routeParams'];

function PecasController(PecasService) {
  var vm = this;
  ((PecasService) => {
    vm.registros = [];
    vm.editing = false;
    vm.reverse = true;
    vm.titulo = "Peças";
    vm.modelOptions = {
      updateOn: 'blur default'
    , debounce: {
        default: 1000
      , blur: 0
      }
    }

    PecasService
    .list()
    .then(
    function success(data) {
      // console.log('Data: ', data.data);
      vm.registros = data.data;
      },
      function fail(err) {
          console.log('Erro: ', err);
          return exception.catcher('XHR Failed for getPeople')(err);
      });

    vm.remove = remove;
    function remove(pecas) {
      const filtrarPecasRemovido = function(el){
        return pecas.id !== el.id;
      }
      if(confirm('Deseja REALMENTE remover esse usuário?')) {
        PecasService
        .remove(pecas)
        .then(
          function success(data) {
            // console.log('REMOVIDO: ', data);
            // if(data.n == 1) vm.pecass = vm.pecass.filter(filtrarPecasRemovido);
            vm.registros = vm.registros.filter(filtrarPecasRemovido);
            console.log('FILTRADOS: ', vm.registros);
            },
            function fail(err) {
              console.log('Erro: ', err);
          });
        }
      else alert('UFA! Ainda bem!');
    }
  })(PecasService);
}

const myDate = function ($timeout, $filter) {
  return {
          require: 'ngModel',

          link: function ($scope, $element, $attrs, $ctrl)
          {
              var dateFormat = 'yyyy/MM/dd';
              $ctrl.$parsers.push(function (viewValue)
              {
                  //convert string input into moment data model
                  var pDate = Date.parse(viewValue);
                  if (isNaN(pDate) === false) {
                      return new Date(pDate);
                  }
                  return undefined;

              });
              $ctrl.$formatters.push(function (modelValue)
              {
                  var pDate = Date.parse(modelValue);
                  if (isNaN(pDate) === false) {
                      return $filter('date')(new Date(pDate), dateFormat);
                  }
                  return undefined;
              });
              $element.on('blur', function ()
              {
                  var pDate = Date.parse($ctrl.$modelValue);
                  if (isNaN(pDate) === true) {
                      $ctrl.$setViewValue(null);
                      $ctrl.$render();
                  } else {
                      if ($element.val() !== $filter('date')(new Date(pDate), dateFormat)) {
                          $ctrl.$setViewValue($filter('date')(new Date(pDate), dateFormat));
                          $ctrl.$render();
                      }
                  }

              });
              $timeout(function ()
              {
                  $element.kendoDatePicker({

                      format: dateFormat
                  });

              });
          }
      };
};

angular.module('Pecas', ['angularUtils.directives.dirPagination'])
  .config(['$routeProvider', function($routeProvider) {
    $routeProvider
      .when('/pecas', {
        templateUrl: 'projetoangular/templates/pecas.html',
        controller: 'PecasController',
        controllerAs: 'Pecas'
      })
      .when('/pecas/novo', {
        templateUrl: 'projetoangular/templates/pecas_novo.html',
        controller: 'PecasNovoController',
        controllerAs: 'Pecas'
      })
      .when('/pecas/editar/:id', {
        templateUrl: 'projetoangular/templates/pecas_editar.html',
        controller: 'PecasEditarController',
        controllerAs: 'PecasEditar'
      })
      .when('/pecas/:id', {
        templateUrl: 'projetoangular/templates/pecas-details.html',
        controller: 'PecasDetailsController',
        controllerAs: 'PecasDetails'
      });
  }])
  .service('PecasService', PecasService)
  .directive('myDate', ['$timeout', '$filter', myDate])
  .controller('PecasController', ['PecasService', PecasController])
  .controller('PecasDetailsController', PecasDetailsController)
  .controller('PecasNovoController', ['PecasService', PecasNovoController])
  // .controller('PecasEditarController', ['PecasService', PecasEditarController]);
  // .factory('dataservice', dataservice)
  .controller('PecasEditarController', PecasEditarController);