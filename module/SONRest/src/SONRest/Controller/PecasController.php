<?php

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PecasController extends AbstractRestfulController {

    public function getList() {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $data = $em->getRepository('Application\Entity\Pecas')->findAll();
       return $data;
    }

    // get
    public function get($id) {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $data = $em->getRepository('Application\Entity\Pecas')->find($id);
        return $data;
    }

    // post
    public function create($dados) {

            $servicePecas = $this->getServiceLocator()->get('Application\Service\Pecas');

            if(isset($dados['id'])) {
                $pecas = $servicePecas->update($dados);
            } else {
                $pecas = $servicePecas->insert($dados);
            }

            if($pecas) {
                return new JsonModel(array('data'=>array('id'=>$pecas->getId(),'success'=>true)));
            } else {
                return new JsonModel(array('data'=>array('success'=>false)));
            }
    }

    // put
    public function update($idpecas, $dados)
    {
        $servicePecas = $this->getServiceLocator()->get('Application\Service\Pecas');

        $pecas = $servicePecas->update($param);

        if($pecas) {
            return $pecas;
        } else {
            return array('success'=>false);
        }
    }

    // delete
    public function delete($idpecas)
    {
        $servicePecas = $this->getServiceLocator()->get('Application\Service\Pecas');
        $result = $servicePecas->delete($idpecas);
        if($result) return $result;
    }

}