function TrampoService($http) {
  const BASE_URL = '/api/trampo/';

  this.list = function() {
    const request = {
      url: BASE_URL,
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

  this.salvar = function(trampo) {
      const request = {
        url: BASE_URL,
        method: 'POST',
        data: trampo
      }
      return $http(request);
  }

    this.remove = function(trampo) {
      const request = {
        url: BASE_URL + trampo.id,
        method: 'DELETE'
      }
      return $http(request);
    }

}

function TrampoController(TrampoService) {
  var vm = this;
  vm.registros = [];
  vm.editing = false;
  vm.reverse = true;
  vm.titulo = "Peças";
  vm.modelOptions = {
      updateOn: 'blur default'
      ,debounce: {
      default: 1000
    , blur: 0
    }
  }

    TrampoService
    .list()
    .then(
    function success(data) {
      // console.log('Data: ', data.data);
      vm.registros = data.data;
      },
      function fail(err) {
          console.log('Erro: ', err);
      });

    vm.remove = remove;
    function remove(trampo) {
      const filtrarTrampoRemovido = function(el){
        return trampo.id !== el.id;
      }
      if(confirm('Deseja REALMENTE remover esse trampo?')) {
        TrampoService
        .remove(trampo)
        .then(
          function success(data) {
            // console.log('REMOVIDO: ', data);
            // if(data.n == 1) vm.trampos = vm.trampos.filter(filtrarTrampoRemovido);
            vm.registros = vm.registros.filter(filtrarTrampoRemovido);
            console.log('FILTRADOS: ', vm.registros);
            },
          function fail(err) {
              console.log('Erro: ', err);
          });
        }
      else alert('UFA! Ainda bem!');
    }
}
TrampoController.$inject = ['TrampoService'];

function TrampoNovoController ($location,TrampoService) {
    var vm = this;
    vm.submitForm = submitForm;
    vm.tipoTrampo = [];
    vm.tipoTrampo = [
          {conclusao:"PRUDENTE-CIELO-R$ 5,00", nome:"PRUDENTE-CIELO-R$ 5,00", type: "CIELO"},
          {conclusao:"FORA-CIELO-R$ 5,00", nome:"FORA-CIELO-R$ 5,00", type: "CIELO"},
          {conclusao:"PRUDENTE-CIELO-TEF - R$ 4,00", nome:"PRUDENTE-CIELO-TEF - R$ 4,00", type: "CIELO"},
          {conclusao:"FORA-CIELO-TEF - R$ 4,00", nome:"FORA-CIELO-TEF - R$ 4,00", type: "CIELO"},
          {conclusao:"PRUDENTE-ELAVON - R$ 5,00", nome:"PRUDENTE-ELAVON - R$ 5,00", type: "CIELO"},
          {conclusao:"FORA-ELAVON - R$ 5,00", nome:"FORA-ELAVON - R$ 5,00", type: "CIELO"},
          {conclusao:"PRUDENTE-STONE - R$ 4,00", nome:"PRUDENTE-STONE - R$ 4,00", type: "CIELO"},
          {conclusao:"FORA-STONE - R$ 4,00", nome:"FORA-STONE - R$ 4,00", type: "CIELO"}
          /*{conclusao:"FORA-GET-INSTALAÇÃO - R$ 8,00", nome:"FORA-GET-INSTALAÇÃO - R$ 8,00", type: "GET"},
          {conclusao:"FORA-GET-MANUTENÇÃO - R$ 8,00", nome:"FORA-GET-MANUTENÇÃO - R$ 8,00", type: "GET"},
          {conclusao:"FORA-GET-CANCELADA - R$ 3,00", nome:"FORA-GET-CANCELADA - R$ 3,00", type: "GET"},
          {conclusao:"FORA-GET-RETIRADA - R$ 5,00", nome:"FORA-GET-RETIRADA - R$ 5,00", type: "GET"},
          {conclusao:"PRUDENTE-GET-INSTALAÇÃO - R$ 6,00", nome:"PRUDENTE-GET-INSTALAÇÃO - R$ 6,00", type: "GET"},
          {conclusao:"PRUDENTE-GET-MANUTENÇÃO - R$ 6,00", nome:"PRUDENTE-GET-MANUTENÇÃO - R$ 6,00", type: "GET"},
          {conclusao:"PRUDENTE-GET-CANCELADA - R$ 3,00", nome:"PRUDENTE-GET-CANCELADA - R$ 3,00", type: "GET"},
          {conclusao:"PRUDENTE-GET-RETIRADA - R$ 5,00", nome:"PRUDENTE-GET-RETIRADA - R$ 5,00", type: "GET"},
          {nome: 'Carro', apelido: 'carro', type: 'veiculos', active: true}
          {nome: 'Moto', apelido: 'moto', type: 'veiculos', active: false}
        */
    ];
    vm.conclusao = vm.tipoTrampo[0];

   vm.form = {
                 data: new Date(),
                 conclusao: vm.tipoTrampo[0],
   };

    function submitForm(trampo) {
        console.log('submitForm', trampo);

        TrampoService
        .salvar(trampo)
        .then(
          function success(data) {
            console.log('Data: ', data.data);
            vm.cadastrado = data.data;
            $location.path('#/trampo');
            },
            function fail(err) {
                console.log('Erro: ', err);
                vm.erro = err;
            });
      }
}
TrampoNovoController.$inject = ['$location','TrampoService'];

function TrampoEditarController($location,TrampoService, $routeParams) {
  var vm = this;
  vm.editing = false;
  vm.reverse = false;
  vm.tipoTrampoEditar = [];
  vm.tipoTrampo = [
              {conclusao:"PRUDENTE-CIELO-R$ 5,00", nome:"PRUDENTE-CIELO-R$ 5,00", type: "CIELO"},
              {conclusao:"FORA-CIELO-R$ 5,00", nome:"FORA-CIELO-R$ 5,00", type: "CIELO"},
              {conclusao:"PRUDENTE-CIELO-TEF - R$ 4,00", nome:"PRUDENTE-CIELO-TEF - R$ 4,00", type: "CIELO"},
              {conclusao:"FORA-CIELO-TEF - R$ 4,00", nome:"FORA-CIELO-TEF - R$ 4,00", type: "CIELO"},
              {conclusao:"PRUDENTE-ELAVON - R$ 5,00", nome:"PRUDENTE-ELAVON - R$ 5,00", type: "CIELO"},
              {conclusao:"FORA-ELAVON - R$ 5,00", nome:"FORA-ELAVON - R$ 5,00", type: "CIELO"},
              {conclusao:"FORA-STONE - R$ 4,00", nome:"FORA-STONE - R$ 4,00", type: "CIELO"},
              {conclusao:"PRUDENTE-STONE - R$ 4,00", nome:"PRUDENTE-STONE - R$ 4,00", type: "CIELO"},
    ];

    TrampoService
           .listar($routeParams.id)
           .then(
             function success(data) {
               console.log('Editar - data: ', data.data);
               var today = new Date(data.data.data);
               vm.form = {
                       data: new Date(today.getFullYear(),today.getMonth(), today.getDate()),
                       conclusao:data.data.conclusao,
                       ec:data.data.ec,
                       id:data.data.id,
                       nroos:data.data.nroos,
                       valor:data.data.valor,
                       obs:data.data.obs,
                       id:data.data.id,
               };
             },
             function fail(err) {
               console.log('Erro - Editar: ', err);
             }
         );

    vm.submitForm = submitForm;
    function submitForm(trampo) {
        console.log('Editar - submitForm', trampo);

        TrampoService
        .salvar(trampo)
        .then(
          function success(data) {
            console.log('Editar: ', data);
            vm.trampo = data;
            $location.path('/trampo/');
          },
          function fail(err) {
            console.log('Erro: ', err);
            vm.erro = err;
          }
        );
    }
}
TrampoEditarController.$inject = ['$location','TrampoService','$routeParams'];

function TrampoDetailsController($http, $routeParams) {
  var vm = this;
  vm.routeParams = $routeParams;
  vm.editing = false;
  vm.reverse = false;
  vm.trampo = [];

  const url = '/api/trampo/'+$routeParams.id;
  const method = 'GET';
  $http({
    url: url,
    method: method
  })
  .then(
      function success(data) {
        console.log('Data: ', data.data);
        vm.trampo = data.data;
      },
      function fail(err) {
        console.log('Erro: ', err);
      }
  );
}
TrampoDetailsController.$inject = ['$http', '$routeParams'];

angular.module('Trampo', ['angularUtils.directives.dirPagination'])
  .config(['$routeProvider', function($routeProvider) {
    $routeProvider
      .when('/trampo', {
        templateUrl: 'projetoangular/templates/trampo.html',
        controller: 'TrampoController',
        controllerAs: 'Trampo'
      })
      .when('/trampo/novo', {
        templateUrl: 'projetoangular/templates/trampo_novo.html',
        controller: 'TrampoNovoController',
        controllerAs: 'Trampo'
      })
      .when('/trampo/editar/:id', {
        templateUrl: 'projetoangular/templates/trampo_editar.html',
        controller: 'TrampoEditarController',
        controllerAs: 'TrampoEditar'
      })
      .when('/trampo/:id', {
        templateUrl: 'projetoangular/templates/trampo_details.html',
        controller: 'TrampoDetailsController',
        controllerAs: 'TrampoDetails'
      });
  }])
  .service('TrampoService', TrampoService)
  .controller('TrampoController', ['TrampoService', TrampoController])
  .controller('TrampoDetailsController', TrampoDetailsController)
  .controller('TrampoNovoController', TrampoNovoController)
  .controller('TrampoEditarController', ['$location','TrampoService', '$routeParams',TrampoEditarController]);