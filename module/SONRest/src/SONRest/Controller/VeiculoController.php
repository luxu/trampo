<?php

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class VeiculoController extends AbstractRestfulController
{

    // get
    public function getList()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Veiculo')->findAll();

        return $data;
    }

    // get
    public function get($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Veiculo')->find($id);

        return $data;//->getResult();
    }

    // post
    public function create($dados)
    {

        $serviceVeiculo = $this->getServiceLocator()->get('Application\Service\Veiculo');

        $veiculo = $serviceVeiculo->insert($dados);

        if($veiculo) {
            return $veiculo;
        } else {
            return array('success'=>false);
        }

    }

    // put
    public function update($id, $dados)
    {
        $serviceVeiculo = $this->getServiceLocator()->get('Application\Service\Veiculo');
        // $param['id'] = $id;
        // $param['data'] = $dados['data'];
        // $param['conclusao'] = $dados['conclusao'];
        // $param['ec'] = $dados['ec'];
        // $param['nroos'] = $dados['nroos'];
        // $param['valor'] = $dados['valor'];

        // $trampo = $serviceVeiculo->update($param);
        $trampo = $serviceVeiculo->update($dados);

        if($trampo) {
            return $trampo;
        } else {
            return array('success'=>false);
        }
    }

    // delete
    public function delete($id)
    {
        $serviceVeiculo = $this->getServiceLocator()->get('Application\Service\Veiculo');
        $result = $serviceVeiculo->delete($id);
        if($result) return $result;
    }

}