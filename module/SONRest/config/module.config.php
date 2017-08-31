<?php

return array(
    'router' => array(
        'routes' => array(
            'rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/:controller[/:action][/:id[/]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[a-zA-Z0-9_-]*'
                    )
                )
            )
        )
    ),

    'controllers' => array(
        'invokables' => array(
            'trampo' => 'SONRest\Controller\TrampoController',
            'pecas' => 'SONRest\Controller\PecasController',
            'itenspecas' => 'SONRest\Controller\ItensPecasController',
            'listaritenspecas' => 'SONRest\Controller\ListarItensPecasController',
            'veiculo' => 'SONRest\Controller\VeiculoController',
            'rotas' => 'SONRest\Controller\RotasController',
            'usuarios' => 'SONRest\Controller\UsuariosController',
        )
    ),

    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__.'_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__.'/../src/'.__NAMESPACE__.'/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__.'\Entity' => __NAMESPACE__.'_driver'
                )
            )
        ),
    ),
);