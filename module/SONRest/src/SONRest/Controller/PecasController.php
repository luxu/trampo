<?php

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PecasController extends AbstractRestfulController
{

    public function getList() {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Pecas')->findAll();

       return $data;
    }

    // get
    public function get($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Pecas')->find($id);

        return $data;//->getResult();
    }

    /* editar
    public function get($id)  {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $data = $em->getRepository('Application\Entity\Pecas')->find($id);
        return $data;
    }
    */

    // post
    public function create($dados)
    {
        $servicePecas = $this->getServiceLocator()->get('Application\Service\Pecas');
        $data = $dados['data'];
        $veiculo = $dados['veiculo'];
        $proxtroca = $dados['proxtroca'];
        $troca = $dados['troca'];
        $comercio = $dados['comercio'];
        $local = $dados['local'];

        $pecas = $servicePecas->insert($dados);
        if($pecas) {
            return $pecas;
        } else {
            return array('success'=>false);
        }

    }

    // put
    public function update($idpecas, $dados)
    {
        $servicePecas = $this->getServiceLocator()->get('Application\Service\Pecas');
        $param['idpecas'] = $idpecas;
        $param['data'] = $dados['data'];
        $param['veiculo'] = $dados['veiculo'];
        $param['proxtroca'] = $dados['proxtroca'];
        $param['troca'] = $dados['troca'];
        $param['comercio'] = $dados['comercio'];
        $param['local'] = $dados['local'];

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