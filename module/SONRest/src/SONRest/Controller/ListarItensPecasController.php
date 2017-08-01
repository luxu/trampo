<?php

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ListarItensPecasController extends AbstractRestfulController  {

    // get
    public function get($id)  {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\ItensPecas')->find($id);

        return $data;
    }

}