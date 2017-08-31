function RotasService($http) {
  const BASE_URL = '/api/rotas/';
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

  this.remove = function(rotas) {
      const request = {
        url: BASE_URL + rotas.id,
        method: 'DELETE'
      }
      return $http(request);
  }

}

RotasController.$inject = ['RotasService'];

function RotasController(RotasService) {
  var vm = this;
  ((RotasService) => {
    vm.registros = [];
    vm.editing = false;
    vm.reverse = true;
    vm.titulo = "Rotas";
    vm.modelOptions = {
      updateOn: 'blur default'
    , debounce: {
        default: 1000
      , blur: 0
      }
    }

    RotasService
    .list()
    .then(
    function success(data) {
      vm.registros = data.data;
      },
      function fail(err) {
          console.log('Erro: ', err);
      });

    vm.remove = remove;
    function remove(rotas) {
      const filtrarRotasRemovido = function(el){
        return rotas.id !== el.id;
      }
      if(confirm('Deseja REALMENTE remover esse usuário?')) {
        RotasService
        .remove(rotas)
        .then(
          function success(data) {
            console.log('REMOVIDO: ', data);
            // if(data.n == 1) vm.rotass = vm.rotass.filter(filtrarRotasRemovido);
            vm.registros = vm.registros.filter(filtrarRotasRemovido);
            // console.log('REMOVIDO: ', vm.registros);
            },
            function fail(err) {
              console.log('Erro: ', err);
          });
        }
      else alert('UFA! Ainda bem!');
    }
  })(RotasService);
}

function RotasNovoController ($location,RotasService) {
  var vm = this;
  ((RotasService) => {
      vm.submitForm = submitForm;
      vm.tipoCidades = [];
      vm.tipoCidades = [
        {"id":1,"group": "Group P","label": "Presidente Prudente"},
        {"id":2,"group": "Group P","label": "Presidente Venceslau"},
        {"id":3,"group": "Group P","label": "Presidente Bernardes"},
        {"id":4,"group": "Group S","label": "Santo Anastácio"},
        {"id":5,"group": "Group R","label": "Ribeirão dos Indíos"},
        {"id":6,"group": "Group S","label": "Sandovalina"},
        {"id":7,"group": "Group T","label": "Tarabaí"},
        {"id":8,"group": "Group J","label": "Junqueirópolis"},
        {"id":9,"group": "Group D","label": "Dracena"},
        {"id":10,"group": "Group T","label": "Tupi Paulista"},
        {"id":11,"group": "Group M","label": "Monte Castelo"},
        {"id":12,"group": "Group S","label": "São João do Pau D'Alho"},
        {"id":13,"group": "Group P","label": "Presidente Epitácio"},
        {"id":14,"group": "Group C","label": "Campinal"},
        {"id":15,"group": "Group P","label": "Paraguaçu"},
        {"id":16,"group": "Group Q","label": "Quatá"},
        {"id":17,"group": "Group E","label": "Euclides"},
        {"id":18,"group": "Group P","label": "Primavera"},
        {"id":19,"group": "Group M","label": "Martinópolis"},
        {"id":20,"group": "Group I","label": "Iepe"},
        {"id":21,"group": "Group R","label": "Rancharia"},
      ];

      vm.horas = [
            {hora: '6'},{hora: '7'},{hora: '8'},{hora: '9'},{hora: '10'},{hora: '11'},{hora: '12'},{hora: '13'},{hora: '14'},{hora: '15'},
            {hora: '16'},{hora: '17'},{hora: '18'},{hora: '19'},{hora: '20'},{hora: '21'},{hora: '22'},{hora: '23'},
      ];

      vm.minutos = [
            {minuto: '0'},{minuto: '1'},{minuto: '2'},{minuto: '3'},{minuto: '4'},{minuto: '5'},{minuto: '6'},{minuto: '7'},{minuto: '8'},{minuto: '9'},{minuto: '10'},
            {minuto: '11'},{minuto: '12'},{minuto: '13'},{minuto: '14'},{minuto: '15'},{minuto: '16'},{minuto: '17'},{minuto: '18'},{minuto: '19'},{minuto: '20'},
            {minuto: '21'},{minuto: '22'},{minuto: '23'},{minuto: '24'},{minuto: '25'},{minuto: '26'},{minuto: '27'},{minuto: '28'},{minuto: '29'},{minuto: '30'},
            {minuto: '31'},{minuto: '32'},{minuto: '33'},{minuto: '34'},{minuto: '35'},{minuto: '36'},{minuto: '37'},{minuto: '38'},{minuto: '39'},{minuto: '40'},
            {minuto: '41'},{minuto: '42'},{minuto: '43'},{minuto: '44'},{minuto: '45'},{minuto: '46'},{minuto: '47'},{minuto: '48'},{minuto: '49'},{minuto: '50'},
            {minuto: '51'},{minuto: '52'},{minuto: '53'},{minuto: '54'},{minuto: '55'},{minuto: '56'},{minuto: '57'},{minuto: '58'},{minuto: '59'},{minuto: '60'},
      ];

      vm.form = {
              data: new Date()
      };

      function submitForm(rotas) {
        console.log('submitForm', rotas);

        RotasService
        .salvar(rotas)
        .then(
          function success(data) {
            console.log('Data: ', data);
            vm.cadastrado = data.data;
            $location.path('/rotas/');
            },
            function fail(err) {
                console.log('Erro: ', err);
                vm.erro = err;
            });
      }
  })(RotasService);
}
RotasNovoController.$inject = ['$location','RotasService'];

function RotasEditarController(RotasService,$routeParams) {
  var vm = this;
  vm.editing = false;
  vm.reverse = false;
  vm.tipoRotasEditar = [];
  vm.tipoCidades = [];
  vm.tipoCidades = [
        {"id":1,"group": "Group P","label": "Presidente Prudente"},
        {"id":2,"group": "Group P","label": "Presidente Venceslau"},
        {"id":3,"group": "Group P","label": "Presidente Bernardes"},
        {"id":4,"group": "Group S","label": "Santo Anastácio"},
        {"id":5,"group": "Group R","label": "Ribeirão dos Indíos"},
        {"id":6,"group": "Group S","label": "Sandovalina"},
        {"id":7,"group": "Group T","label": "Tarabaí"},
        {"id":8,"group": "Group J","label": "Junqueirópolis"},
        {"id":9,"group": "Group D","label": "Dracena"},
        {"id":10,"group": "Group T","label": "Tupi Paulista"},
        {"id":11,"group": "Group M","label": "Monte Castelo"},
        {"id":12,"group": "Group S","label": "São João do Pau D'Alho"},
        {"id":13,"group": "Group P","label": "Presidente Epitácio"},
        {"id":14,"group": "Group C","label": "Campinal"},
        {"id":15,"group": "Group P","label": "Paraguaçu"},
        {"id":16,"group": "Group Q","label": "Quatá"},
        {"id":17,"group": "Group E","label": "Euclides"},
        {"id":18,"group": "Group P","label": "Primavera"},
        {"id":19,"group": "Group M","label": "Martinópolis"},
        {"id":20,"group": "Group I","label": "Iepe"},
        {"id":21,"group": "Group R","label": "Rancharia"},
  ];

  vm.horas = [
        {hora: '6'},{hora: '7'},{hora: '8'},{hora: '9'},{hora: '10'},{hora: '11'},{hora: '12'},{hora: '13'},{hora: '14'},{hora: '15'},
        {hora: '16'},{hora: '17'},{hora: '18'},{hora: '19'},{hora: '20'},{hora: '21'},{hora: '22'},{hora: '23'},
  ];

  vm.minutos = [
        {minuto: '0'},{minuto: '1'},{minuto: '2'},{minuto: '3'},{minuto: '4'},{minuto: '5'},{minuto: '6'},{minuto: '7'},{minuto: '8'},{minuto: '9'},{minuto: '10'},
        {minuto: '11'},{minuto: '12'},{minuto: '13'},{minuto: '14'},{minuto: '15'},{minuto: '16'},{minuto: '17'},{minuto: '18'},{minuto: '19'},{minuto: '20'},
        {minuto: '21'},{minuto: '22'},{minuto: '23'},{minuto: '24'},{minuto: '25'},{minuto: '26'},{minuto: '27'},{minuto: '28'},{minuto: '29'},{minuto: '30'},
        {minuto: '31'},{minuto: '32'},{minuto: '33'},{minuto: '34'},{minuto: '35'},{minuto: '36'},{minuto: '37'},{minuto: '38'},{minuto: '39'},{minuto: '40'},
        {minuto: '41'},{minuto: '42'},{minuto: '43'},{minuto: '44'},{minuto: '45'},{minuto: '46'},{minuto: '47'},{minuto: '48'},{minuto: '49'},{minuto: '50'},
        {minuto: '51'},{minuto: '52'},{minuto: '53'},{minuto: '54'},{minuto: '55'},{minuto: '56'},{minuto: '57'},{minuto: '58'},{minuto: '59'},{minuto: '60'},
  ];
  ((RotasService) => {

  RotasService
  .listar($routeParams.id)
  // .listar(7)
  .then(
    function success(data) {
      console.log('Editar - data: ', data.data);
      var today = new Date(data.data.data);
      today.toLocaleDateString('PT-BR');
      vm.form = {
              id:data.data.id,
              data: new Date(today.getFullYear(),today.getMonth(), today.getDate()+1),
              cidorigem:data.data.cidorigem,
              ciddestino:data.data.ciddestino,
              hrchegada:data.data.hrchegada,
              hrsaida:data.data.hrsaida,
              kminicial:data.data.kminicial,
              kmfinal:data.data.kmfinal
      };
    },
    function fail(err) {
      console.log('Erro - Editar: ', err);
    }
  );

  vm.submitForm = submitForm;
  function submitForm(trampo) {
          console.log('Editar - submitForm', trampo);

          RotasService
          .salvar(trampo)
          .then(
            function success(data) {
              console.log('Editar: ', data);
              vm.trampo = data;
              vm.editado = data.data;
            },
            function fail(err) {
              console.log('Erro: ', err);
              vm.erro = err;
            }
          );
  }
  })(RotasService);
}
RotasEditarController.$inject = ['RotasService','$routeParams'];

function RotasDetailsController($http, $routeParams) {
  var vm = this;
  vm.routeParams = $routeParams;
  vm.editing = false;
  vm.reverse = false;
  vm.rotas = [];

  const url = '/api/rotas/'+$routeParams.id;
  const method = 'GET';
  $http({
    url: url,
    method: method
  })
  .then(
      function success(data) {
        console.log('Data: ', data.data);
        vm.rotas = data.data;
      },
      function fail(err) {
        console.log('Erro: ', err);
      }
  );
}
RotasController.$inject = ['$http', '$routeParams'];

angular.module('Rotas', ['angularUtils.directives.dirPagination'])
  .config(['$routeProvider', function($routeProvider) {
    $routeProvider
      .when('/rotas', {
        templateUrl: 'projetoangular/templates/rotas.html',
        controller: 'RotasController',
        controllerAs: 'Rotas'
      })
      .when('/rotas/novo', {
        templateUrl: 'projetoangular/templates/rotas_novo.html',
        controller: 'RotasNovoController',
        controllerAs: 'Rotas'
      })
      .when('/rotas/editar/:id', {
        templateUrl: 'projetoangular/templates/rotas_editar.html',
        controller: 'RotasEditarController',
        controllerAs: 'RotasEditar'
      })
      .when('/rotas/:id', {
        templateUrl: 'projetoangular/templates/rotas-details.html',
        controller: 'RotasDetailsController',
        controllerAs: 'RotasDetails'
      });
  }])
  .service('RotasService', RotasService)
  .controller('RotasController', ['RotasService', RotasController])
  .controller('RotasDetailsController', RotasDetailsController)
  .controller('RotasNovoController', RotasNovoController)
  .controller('RotasEditarController', ['RotasService', '$routeParams',RotasEditarController]);