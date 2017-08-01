<?php

namespace SONUser;

return array(
    'router' => array(
        'routes' => array(
            'sonuser-register' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/register',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Index',
                        'action' => 'register',
                    )
                )
            ),
            'sonuser-activate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/register/activate[/:key]',
                    'defaults' => array(
                        'controller' => 'SONUser\Controller\Index',
                        'action' => 'activate'
                    )
                )
            ),
            'sonuser-auth' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Auth',
                        'action' => 'index'
                    )
                )
            ),
            'sonuser-logout' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/auth/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Auth',
                        'action' => 'logout'
                    )
                )
            ),
            'sonuser-admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SONUser\Controller',
                        'controller' => 'Users',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'users'
                            )
                        )
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/page/:page]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'SONUser\Controller',
                                'controller' => 'users'
                            )
                        )
                    )
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'SONUser\Controller\Index' => 'SONUser\Controller\IndexController',
            'SONUser\Controller\Users' => 'SONUser\Controller\UsersController',
            'SONUser\Controller\Auth' => 'SONUser\Controller\AuthController',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
    'data-fixture' => array(
        'SONUser_fixture' => __DIR__ . '/../src/SONUser/Fixture',
    ),
);