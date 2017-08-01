
function VeiculoService($http) {
  // const BASE_URL = 'http://localhost:8080/api/server-resources/';
  const BASE_URL = '/api/veiculo/';
  this.list = function() {
    const request = {
      url: BASE_URL,
      method: 'GET'
    }
    return $http(request);
  }

  this.novo = function(veiculo) {
      const request = {
        url: BASE_URL,
        method: 'POST',
        data: veiculo
      }
      return $http(request);
    }

  this.editar = function(veiculo) {
      const request = {
        url: BASE_URL + veiculo.id,
        method: 'GET'
      }
      return $http(request);
    }

  this.remove = function(veiculo) {
      const request = {
        url: BASE_URL + veiculo.id,
        method: 'DELETE'
      }
      return $http(request);
    }
}

function VeiculoNovoController (VeiculoService) {
  var vm = this;
  ((VeiculoService) => {
      vm.submitForm = submitForm;
      vm.tipoVeiculo = [];
      vm.tipoVeiculo.push('Carro');
      vm.tipoVeiculo.push('Moto');
      vm.tipoVeiculoSelecionado = 'Carro';

      function submitForm(veiculo) {
        console.log('submitForm', veiculo);
        // console.log('Data: ', veiculo.data);
        veiculo.distanciapercorrida = veiculo.kmfinal - veiculo.kminicial;
        // console.log('VeiculoService', VeiculoService);

        VeiculoService
        .novo(veiculo)
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
  })(VeiculoService);
}

/*
function VeiculoEditarController(VeiculoService) {
  var vm = this;
  ((VeiculoService) => {
      vm.editing = false;
      vm.reverse = false;
      vm.veiculos = [];

      // const url = 'http://localhost:8080/api/server-resources/'+$routeParams.id;
      // const url = '/api/veiculos/editar/'+$routeParams.id;
      VeiculoService
      .editar(veiculo)
      .then(
        function success(data) {
          console.log('Editar: ', data);
          vm.veiculo = data;
      },
        function fail(err) {
          console.log('Erro: ', err);
          vm.erro = err;
  })(VeiculoService);
}
}
*/

//         VeiculoService
//         .editar(veiculo)
//         .then(
//           function success(data) {
//             console.log('Data: ', data.data);
//             vm.editado = data.data;
//             },
//             function fail(err) {
//                 console.log('Erro: ', err);
//                 vm.erro = err;
//             });
//       }
//   })(VeiculoService);
// }

function VeiculoController(VeiculoService) {
  var vm = this;
  ((VeiculoService) => {
    vm.veiculos = [];
    vm.editing = false;
    vm.reverse = true;
    vm.titulo = "Distância percorrida/litros";
    vm.modelOptions = {
      updateOn: 'blur default'
    , debounce: {
        default: 1000
      , blur: 0
      }
    }

    VeiculoService
    .list()
    .then(
    function success(data) {
      console.log('Data: ', data.data);
      vm.veiculos = data.data;
      },
      function fail(err) {
          console.log('Erro: ', err);
          return exception.catcher('XHR Failed for getPeople')(err);
      });

    vm.remove = remove;
    function remove(veiculo) {
      const filtrarVeiculoRemovido = function(el){
        return veiculo.id !== el.id;
      }
      if(confirm('Deseja REALMENTE remover esse usuário?')) {
        VeiculoService
        .remove(veiculo)
        .then(
          function success(data) {
            // console.log('REMOVIDO: ', data);
            // if(data.n == 1) vm.veiculos = vm.veiculos.filter(filtrarVeiculoRemovido);
            vm.veiculos = vm.veiculos.filter(filtrarVeiculoRemovido);
            // console.log('FILTRADOS: ', filtrados);
            },
            function fail(err) {
              console.log('Erro: ', err);
          });
        }
      else alert('UFA! Ainda bem!');
    }
  })(VeiculoService);
}

angular.module('Veiculo', ['angularUtils.directives.dirPagination'])
  .config(['$routeProvider', function($routeProvider) {
    $routeProvider
      .when('/veiculos', {
        templateUrl: 'projetoangular/templates/veiculo.html',
        controller: 'VeiculoController',
        controllerAs: 'Veiculo'
      })
      .when('/veiculos/novo', {
        templateUrl: 'projetoangular/templates/veiculo_novo.html',
        controller: 'VeiculoNovoController',
        controllerAs: 'Veiculo'
      })
/*
      .when('/veiculos/editar/:id', {
        templateUrl: 'projetoangular/templates/veiculo_editar.html',
        controller: 'VeiculoEditarController',
        controllerAs: 'VeiculoEditar'
      })
*/
      ;
  }])
  .service('VeiculoService', VeiculoService)
  .controller('VeiculoController', ['VeiculoService', VeiculoController])
  .controller('VeiculoNovoController', ['VeiculoService', VeiculoNovoController])
  // .controller('VeiculoEditarController', ['VeiculoService', VeiculoEditarController])

