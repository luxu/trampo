function ItensPecasService($http) {
  const BASE_URL = '/api/itenspecas/';

  this.list = function($idPecas) {
    const request = {
      url: BASE_URL  + $idPecas,
      method: 'GET'
    }
    return $http(request);
  }

  this.listar = function(id) {
      const request = {
        url: BASE_URL + id,
        method: 'GET'
      }
    return $http(request);
  }

  this.salvar = function(itenspecas) {
      const request = {
        url: BASE_URL,
        method: 'POST',
        data: itenspecas
      }
      return $http(request);
  }

  this.remove = function(itenspecas) {
      const request = {
        url: BASE_URL + itenspecas.id,
        method: 'DELETE'
      }
      return $http(request);
    }
}

function ItensPecasController($routeParams,ItensPecasService) {

      var vm = this;
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

      ItensPecasService
      .list($routeParams.idPecas)
      .then(
      function success(data) {
        console.log('Data: ', data.data);
        vm.registros = data.data;
        },
        function fail(err) {
            console.log('Erro - ItensPecasController: ', err);
        });

      vm.remove = remove;
      function remove(itenspecas) {
        const filtrarPecasRemovido = function(el){
          return itenspecas.id !== el.id;
        }
        if(confirm('Deseja REALMENTE remover esse usuário?')) {
          ItensPecasService
          .remove(itenspecas)
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
    }
ItensPecasController.$inject = ['$routeParams','ItensPecasService'];

function ItensPecasNovoController($routeParams,ItensPecasService) {

  var vm = this;
  vm.idPecas = $routeParams.idPecas;

  vm.submitForm = submitForm;

  function submitForm(itenspecas) {
        console.log('submitForm', itenspecas);

        const url = '/api/itenspecas/'+itenspecas.idPecas;
        const method = 'POST';
        const data = itenspecas;

        $http({
          url: url,
          method: method,
          data:data,
          })
          .then(
            function success(data) {
            console.log('Data: ', data.data);
            vm.cadastrado = data.data;
            $location.path('/itenspecas/' + data.data.pecas.id);
            },
            function fail(err) {
                console.log('Erro: ', err);
                vm.erro = err;
            });
  }
}
ItensPecasNovoController.$inject = ['$routeParams','$http'];

function ItensPecasEditarController($location,ItensPecasService, $routeParams) {
  var vm = this;
  vm.editing = false;
  vm.reverse = false;

  ItensPecasService
      .listar($routeParams.id)
      .then(
        function success(data) {
          console.log('Editar - data: ', data.data);
          vm.form = {
                  descricao:data.data.descricao,
                  preco:data.data.preco,
                  qtd:data.data.qtd,
                  idPecas:data.data.pecas.id,
          };
        },
        function fail(err) {
          console.log('Erro - Editar: ', err);
        }
    );

  vm.submitForm = submitForm;
  function submitForm(itenspecas) {
      console.log('Editar - submitForm', itenspecas);

    ItensPecasService
    .salvar(itenspecas)
    .then(
      function success(data) {
        console.log('Editar: ', data);
        vm.itenspecas = data;
      },
      function fail(err) {
        console.log('Erro: ', err);
        vm.erro = err;
      }
    );
  }
}
ItensPecasEditarController.$inject = ['$location','ItensPecasService', '$routeParams'];

function ItensPecasDetailsController($http, $routeParams) {
  var vm = this;
  vm.routeParams = $routeParams;
  vm.editing = false;
  vm.reverse = false;
  vm.itensPecas = [];

  const url = '/api/itenspecas/'+$routeParams.id;
  const method = 'GET';
  $http({
    url: url,
    method: method
  })
  .then(
      function success(data) {
        console.log('Data: ', data.data);
        vm.registros = data.data;
      },
      function fail(err) {
        console.log('Erro: ', err);
      }
  );
}
ItensPecasController.$inject = ['$http', '$routeParams'];

angular.module('ItensPecas', ['angularUtils.directives.dirPagination','ng-currency'])
  .config(['$routeProvider', function($routeProvider) {
    $routeProvider
      .when('/itenspecas/:id', {
        templateUrl: 'projetoangular/templates/itenspecas.html',
        controller: 'ItensPecasController',
        controllerAs: 'ItensPecas'
      })
      .when('/itenspecas/novo/:idPecas', {
        templateUrl: 'projetoangular/templates/itenspecas_novo.html',
        controller: 'ItensPecasNovoController',
        controllerAs: 'ItensPecas'
      })
      .when('/itenspecas/editar/:id', {
        templateUrl: 'projetoangular/templates/itenspecas_editar.html',
        controller: 'ItensPecasEditarController',
        controllerAs: 'ItensPecasEditar'
      })
  }])
  .service('ItensPecasService', ItensPecasService)
  .controller('ItensPecasController', ['$routeParams','ItensPecasService',ItensPecasController])
  .controller('ItensPecasDetailsController', ItensPecasDetailsController)
  .controller('ItensPecasNovoController', ['$routeParams','$http','$location', ItensPecasNovoController])
  .controller('ItensPecasEditarController', ['$location','ItensPecasService','$routeParams',ItensPecasEditarController]);