<?php

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class RotasController extends AbstractRestfulController
{

    // get
    public function getList()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Rotas')->findAll();

        return $data;

        // return new JsonModel(array('data'=>$data));
    }

    // get
    public function get($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Rotas')->find($id);

        return $data;//->getResult();
    }

    // Insere registro - POST
    public function create($data) {

            $serviceRotas = $this->getServiceLocator()->get('Application\Service\Rotas');

            if($data) {

                $rotas = $serviceRotas->insert($data);

                if($rotas) return new JsonModel(array('data'=>array('id'=>$rotas->getId(),'success'=>true)));
                else return new JsonModel(array('data'=>array('success'=>false)));

            }
            else return new JsonModel(array('data'=>array('success'=>false)));
        }

    // alteracao - PUT
    public function update($id, $data) {

        $data['id'] = $id;
        $serviceRotas = $this->getServiceLocator()->get("Application\Service\Rotas");

        if($data) {

            $rotas = $serviceRotas->update($data);

            if($rotas) return new JsonModel(array('data'=>array('id'=>$rotas->getId(),'success'=>true)));
            else return new JsonModel(array('data'=>array('success'=>false)));
        }
        else return new JsonModel(array('data'=>array('success'=>false)));
    }

    // delete - DELETE
    public function delete($id) {

        $serviceRotas = $this->getServiceLocator()->get("Application\Service\Rotas");
        $res = $serviceRotas->delete($id);

        if($res) return new JsonModel(array('data'=>array('success'=>true)));
        else return new JsonModel(array('data'=>array('success'=>false)));
    }

}