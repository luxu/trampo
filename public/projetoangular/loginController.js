function LoginService($http) {
  const BASE_URL = '/api/usuarios/';
  this.logar = function(user) {
    const request = {
      url: BASE_URL + user,
      method: 'GET'
    }
    return $http(request);
  }

  this.list = function() {
    const request = {
      url: BASE_URL,
      method: 'GET'
    }
    return $http(request);
  }

}

function LoginController(LoginService) {
  var vm = this;
  vm.titulo = "Tela de Login";
  vm.submitLogin = submitLogin;

  function submitLogin(login) {
    console.log('submitLogin', login);
    // vm.username = login.username;
    // vm.password = login.password;
    vm.user = login;

    LoginService
      .logar(vm.user)
      .then(
        function success(data) {
          console.log('Data: ', data.data);
          vm.cadastrado = data.data;
          $location.path('/');
          },
          function fail(err) {
              console.log('Erro: ', err);
              vm.erro = err;
    })(LoginService);
  }

}

LoginController.$inject = ['$http', '$routeParams'];

angular.module('Login', ['angularUtils.directives.dirPagination'])
.config(['$routeProvider', function($routeProvider) {
    $routeProvider
      .when('/login', {
        templateUrl: 'projetoangular/templates/login.html',
        controller: 'LoginController',
        controllerAs: 'Login'
      });
  }])
.service('LoginService', LoginService)
.controller('LoginController', ['LoginService', LoginController]);