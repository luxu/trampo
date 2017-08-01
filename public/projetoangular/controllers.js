'use strict'

angular.module('myApp.controllers',['ngRoute','myApp.services','checklist-model'])
    .controller('TrampoCtrl',
        ['$scope','TrampoSrv','$location','$routeParams','$http',
            function($scope, TrampoSrv, $location,$routeParams,$http) {

                $scope.titulo = "Trampo";

                $scope.load = function() {
                    $scope.registros = TrampoSrv.query();
                }

                $scope.get = function() {
                    $scope.item = TrampoSrv.get({id: $routeParams.id});
                }

                // função para enviar o formulário depois que a validação estiver ok
                $scope.submitForm = function(isValid,item) {
                    // verifica se o formulário é válido
                    if (isValid) {
                        $scope.result = TrampoSrv.save(
                            {},
                            item,
                            function(data, status, headers, config) {
                                $location.path('/trampo/');
                            },
                            function(data, status, headers, config) {
                                alert('Erro ao inserir registro: '+data.messages);
                            }
                        )
                    }
                }

                $scope.editar = function(isValid,item) {
                    // verifica se o formulário é válido
                    if (isValid) {
                        $scope.result = TrampoSrv.update(
                            {id: $routeParams.id},
                            item,
                            function(data, status, headers, config) {
                                $location.path('/trampo/');
                            },
                            function(data, status, headers, config) {
                                alert('Erro ao inserir registro: '+data.messages);
                            }
                        )
                    }
                }

                $scope.delete = function(c) {
                    if(confirm('Deseja realmente excluir esse registro?')) {
                        TrampoSrv.remove(
                            {id: c.id},
                            {},
                            function(data, status, headers, config) {
                                $location.path('/trampo/');
                            },
                            function(data, status, headers, config) {
                                alert('Erro ao deletar registro: '+data.messages);
                            }
                        )
                    }
                }

                $scope.consultaPorTecnologia = function (dados) {
                    var tipo = $scope.tipo;
                    var totalDinheiro = 0;
                    var totalMaquina = 0;
                    var data = {
                    dados: dados,
                    tipo: tipo
                    };
                    $http.post('api/trampo/listarPorTecnologia', JSON.stringify(data)).then(
                      function (response) {
                            $scope.registros = response.data;
                            var dados = $scope.registros;
                            for (var i=0; i < dados.length; i++) {
                                totalDinheiro += parseInt(dados[i].valor);
                                totalMaquina += 1;
                            }
                            $scope.totalDinheiro = totalDinheiro;
                            $scope.totalMaquina = totalMaquina;
                        }, function (response) {
                          console.log('Serviço não existe: ' + response.data);
                    });
                };

                $scope.consultaPorData = function (dados) {
                    var totalDinheiro = 0;
                    var totalMaquina = 0;
                    var data = {
                    dados: dados,
                    };
                    $http.post('api/trampo/listarPorData', JSON.stringify(data)).then(
                      function (response) {
                            $scope.registros = response.data;
                            var dados = $scope.registros;
                            for (var i=0; i < dados.length; i++) {
                                totalDinheiro += parseInt(dados[i].valor);
                                totalMaquina += 1;
                            }
                            $scope.totalDinheiro = totalDinheiro;
                            $scope.totalMaquina = totalMaquina;
                        }, function (response) {
                          console.log('Serviço não existe: ' + response.data);
                    });
                };

                $scope.columns = [
                    {text:"NRO_OS",predicate:"nrooos",sortable:true,dataType:"number"},
                    {text:"Data",predicate:"data",sortable:true},
                    {text:"EC",predicate:"ec",sortable:true},
                    {text:"Conclusão",predicate:"conclusao",sortable:true},
                    {text:"Obs",predicate:"obs",sortable:true},
                    {text:"Valor",predicate:"valor",sortable:true},
                    {text:"Ação",predicate:"",sortable:false}
                ];

                $scope.listacheckbox = [
                    {id: 1, name: 'GET'},
                    {id: 2, name: 'CIELO'},
                    {id: 3, name: 'ELAVON'},
                    {id: 4, name: 'STONE'},
                    {id: 5, name: 'TODOS'}
                ];

                $scope.dados = {
                            item: []
                        };

                $scope.consultas = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"Data",predicate:"data",sortable:true},
                    {text:"EC",predicate:"ec",sortable:true},
                    {text:"OS",predicate:"nroos",sortable:true},
                    {text:"Conclusão",predicate:"conclusao",sortable:true},
                    {text:"Valor",predicate:"valor",sortable:true},
                ];

                $scope.conclusao = [
                    {label:"PRUDENTE-CIELO-R$ 5,00", type: "CIELO"},
                    {label:"FORA-CIELO-R$ 5,00", type: "CIELO"},
                    {label:"PRUDENTE-CIELO-TEF - R$ 4,00", type: "CIELO"},
                    {label:"FORA-CIELO-TEF - R$ 4,00", type: "CIELO"},
                    {label:"FORA-GET-INSTALAÇÃO - R$ 8,00", type: "GET"},
                    {label:"FORA-GET-MANUTENÇÃO - R$ 8,00", type: "GET"},
                    {label:"FORA-GET-CANCELADA - R$ 3,00", type: "GET"},
                    {label:"FORA-GET-RETIRADA - R$ 5,00", type: "GET"},
                    {label:"PRUDENTE-GET-INSTALAÇÃO - R$ 6,00", type: "GET"},
                    {label:"PRUDENTE-GET-MANUTENÇÃO - R$ 6,00", type: "GET"},
                    {label:"PRUDENTE-GET-CANCELADA - R$ 3,00", type: "GET"},
                    {label:"PRUDENTE-GET-RETIRADA - R$ 5,00", type: "GET"},
                    {label:"PRUDENTE-ELAVON - R$ 5,00", type: "CIELO"},
                    {label:"FORA-ELAVON - R$ 5,00", type: "CIELO"},
                    {label:"PRUDENTE-STONE - R$ 4,00", type: "CIELO"},
                    {label:"FORA-STONE - R$ 4,00", type: "CIELO"},
                ]
            }  // fim do TrampoCtrl
        ])
        .controller('PecasCtrl',
            ['$scope','PecasSrv','$location','$routeParams',
                function($scope, PecasSrv, $location,$routeParams) {

                    $scope.titulo = "Peças";
                    $scope.mensagem = "";

                    $scope.load = function() {
                        $scope.registros = PecasSrv.query();
                    }

                    // $scope.getCategorias = function() {
                    //     $scope.categorias = CategoriasSrv.query();
                    // }
                    // $scope.getCategorias();

                    $scope.get = function() {
                        $scope.item = PecasSrv.get({id: $routeParams.id});
                    }

                    $scope.add = function(item) {
                        $scope.result = PecasSrv.save(
                            {},
                            item,
                            function(data, status, headers, config) {
                                // $location.path('/pecas/');
                                $scope.mensagem = "Peça incluida com sucesso!"
                            },
                            function(data, status, headers, config) {
                                $scope.mensagem = "Erro ao inserir registro: " + data.messages[0];
                                console.log($scope.mensagem);
                            }
                        )
                    }

                    $scope.editar = function(item) {
                        $scope.result = PecasSrv.update(
                            {id: $routeParams.id},
                            item,
                            function(data, status, headers, config) {
                                $location.path('/pecas/');
                            },
                            function(data, status, headers, config) {
                                alert('Erro ao inserir registro: '+data.messages[0]);
                            }
                        )
                    }

                    $scope.delete = function(id) {
                        if(confirm('Deseja realmente excluir esse registro?')) {
                            PecasSrv.remove(
                                {id: id},
                                {},
                                function(data, status, headers, config) {
                                    $location.path('/pecas/');
                                },
                                function(data, status, headers, config) {
                                    alert('Erro ao inserir registro: '+data.messages[0]);
                                }
                            )
                        }
                    }

                    $scope.columns = [
                                        {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                                        {text:"Data",predicate:"data",sortable:true},
                                        {text:"Comércio",predicate:"comercio",sortable:true},
                                        {text:"Veiculo",predicate:"veiculo",sortable:true},
                                        {text:"Local",predicate:"local",sortable:true},
                                        {text:"Troca",predicate:"troca",sortable:true},
                                        {text:"Próx. Troca",predicate:"proxTroca",sortable:true},
                                        {text:"Ação",predicate:"",sortable:false}
                                    ];
                }  // fim do PecasCtrl
            ]
        )
        .controller('ItensPecasCtrl',
            ['$scope','ItensPecasSrv','$location','$routeParams',
                function($scope, ItensPecasSrv, $location,$routeParams) {

                    $scope.titulo = "Peças Trocadas";

                    $scope.load = function() {
                        $scope.registros = ItensPecasSrv.query();
                    }

                    $scope.get = function() {
                        $scope.item = ItensPecasSrv.get({id: $routeParams.id});
                    }

                    $scope.add = function(item) {
                        $scope.result = ItensPecasSrv.save(
                            {},
                            item,
                            function(data, status, headers, config) {
                                $location.path('/pecas/');
                            },
                            function(data, status, headers, config) {
                                alert('Erro ao inserir registro: '+data.messages[0]);
                            }
                        )
                    }

                    $scope.editar = function(item) {
                        $scope.result = ItensPecasSrv.update(
                            {id: $routeParams.id},
                            item,
                            function(data, status, headers, config) {
                                $location.path('/pecas/');
                            },
                            function(data, status, headers, config) {
                                alert('Erro ao inserir registro: '+data.messages[0]);
                            }
                        )
                    }

                    $scope.delete = function(id) {
                        if(confirm('Deseja realmente excluir esse registro?')) {
                            ItensPecasSrv.remove(
                                {id: id},
                                {},
                                function(data, status, headers, config) {
                                    $location.path('/pecas/');
                                },
                                function(data, status, headers, config) {
                                    alert('Erro ao inserir registro: '+data.messages[0]);
                                }
                            )
                        }
                    }

                    $scope.columns = [
                                        {text:"ID",predicate:"idpecas",sortable:true,dataType:"number"},
                                        {text:"Peças",predicate:"pecas_id",sortable:true},
                                        {text:"Descrição",predicate:"descricao",sortable:true},
                                        {text:"Preço",predicate:"preco",sortable:true,dataType:"number"},
                                        {text:"Quantidade",predicate:"qtd",sortable:true,dataType:"number"},
                                        {text:"Total",predicate:"total",sortable:true,dataType:"number"},
                                    ];
                }  // fim do ItensPecasCtrl
            ]
        );