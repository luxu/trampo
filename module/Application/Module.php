<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
          'factories' => array(
              'Application\Service\Trampo' => function($sm) {
                      $em = $sm->get('Doctrine\ORM\EntityManager');
                      $trampoService = new \Application\Service\Trampo($em);
                      return $trampoService;
              },
              'Application\Service\Pecas' => function($sm) {
                      $em = $sm->get('Doctrine\ORM\EntityManager');
                      $pecasService = new \Application\Service\Pecas($em);
                      return $pecasService;
              },
              'Application\Service\ItensPecas' => function($sm) {
                      $em = $sm->get('Doctrine\ORM\EntityManager');
                      $itensPecasService = new \Application\Service\ItensPecas($em);
                      return $itensPecasService;
              },
              'Application\Service\Veiculo' => function($sm) {
                      $em = $sm->get('Doctrine\ORM\EntityManager');
                      $veiculoService = new \Application\Service\Veiculo($em);
                      return $veiculoService;
              },
              'Application\Service\Usuarios' => function($sm) {
                      $em = $sm->get('Doctrine\ORM\EntityManager');
                      $usuariosService = new \Application\Service\Usuarios($em);
                      return $usuariosService;
              }
           )
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
