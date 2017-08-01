function ItensPecasService($http) {
  const BASE_URL = '/api/itenspecas/';
  this.list = function($idPecas) {
    $idPecas = $idPecas;
    const request = {
      url: BASE_URL  + $idPecas,
      method: 'GET'
    }
    return $http(request);
  }

  this.novo = function(itenspecas) {
      const request = {
        url: BASE_URL,
        method: 'POST',
        data: itenspecas
      }
      return $http(request);
    }

  this.editar = function(itenspecas) {
      const request = {
        url: BASE_URL + 'editar/' + itenspecas.id,
        method: 'GET'
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

/*
function IdPecasService($routerParams) {
    // var vm = this;
    id = null;
    return {
        setIDPecas: setIDPecas,
        getIDPecas: getIDPecas
    };

    function setIDPecas($routerParams) {
        id = $routerParams.id;
    };

    function getIDPecas() {
        return id
    };
}
IdPecasService.$inject = ['$routerParams'];
*/

function ItensPecasController($routeParams,$http) {
      var vm = this;
      vm.registros = [];
      vm.idPecas = $routeParams.id;
      // vm.idPecas = IdPecasService.getIDPecas;
      // const url = '/api/itenspecas/'+$routeParams.idPecas;
      const url = '/api/itenspecas/'+vm.idPecas;
      // const url = '/api/itenspecas/'+ vm.idPecas;
      const method = 'GET';

      $http({
        url: url,
        method: method
      })
      .then(
          function success(data) {
              console.log('Data: ', data.data);
              if(data.data != false)
                vm.registros = data.data;
              else vm.registros = 0;
          },
          function fail(err) {
            console.log('Erro: ', err);
          }
      );
    }
ItensPecasController.$inject = ['$routeParams','$http'];

function ItensPecasNovoController($routeParams,$http) {

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
            },
            function fail(err) {
                console.log('Erro: ', err);
                vm.erro = err;
            });
  }
}
ItensPecasNovoController.$inject = ['$routeParams','$http'];

function ItensPecasEditarController($routeParams,$http) {
  var vm = this;
  vm.id = $routeParams.id;
  vm.editing = false;
  vm.reverse = false;
  vm.tipoPecasEditar = [];

  const url = '/api/listaritenspecas/'+vm.id;
  const method = 'GET';
  $http({
    url: url,
    method: method
  })
  .then(
      function success(data) {
        console.log('Data: ', data.data);
        vm.pecas = data.data;
        // vm.tipoPecasEditarSelecionada = data.data.veiculo;
        vm.form = angular.copy(vm.pecas);
        vm.editing = true;
      },
      function fail(err) {
        console.log('Erro - Editar: ', err);
      }
  );
}
ItensPecasEditarController.$inject = ['$routeParams','$http'];

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
      // .when('/itenspecas/:id', {
      //   templateUrl: 'projetoangular/templates/itenspecas-details.html',
      //   controller: 'ItensPecasDetailsController',
      //   controllerAs: 'PecasDetails'
      // });
  }])
  .service('ItensPecasService', ItensPecasService)
  // .service('IdPecasService', ['$routeParams',IdPecasService])
  // .directive('myDate', ['$timeout', '$filter', myDate])
  .controller('ItensPecasController', ['$routeParams','$http',ItensPecasController])
  // .controller('ItensPecasController', ['IdPecasService',ItensPecasController])
  // .controller('ItensPecasController', ItensPecasController)
  .controller('ItensPecasDetailsController', ItensPecasDetailsController)
  .controller('ItensPecasNovoController', ['$routeParams','$http', ItensPecasNovoController])
  // .controller('ItensPecasNovoController', ['ItensPecasService', 'IdPecasService', ItensPecasNovoController])
  // .controller('PecasEditarController', ['PecasService', PecasEditarController]);
  .controller('ItensPecasEditarController', ['$routeParams','$http',ItensPecasEditarController]);