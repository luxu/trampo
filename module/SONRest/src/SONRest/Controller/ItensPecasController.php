<?php

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ItensPecasController extends AbstractRestfulController  {

    // get
    public function get($id)  {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\ItensPecas')->getItensPecas($id);

        return $data;
    }

    // post
    public function create($dados) {

        $serviceItensPecas = $this->getServiceLocator()->get('Application\Service\ItensPecas');
        $dados['total'] = $dados['preco'] * $dados['qtd'];

        $ItensPecas = $serviceItensPecas->insert($dados);
        if($ItensPecas) {
            return $ItensPecas;
        } else {
            return array('success'=>false);
        }

    }

    // put
    public function update($idpecas, $dados)
    {
        $servicePecas = $this->getServiceLocator()->get('Application\Service\ItensPecas');
        $dados['total'] = $dados['preco'] * $dados['qtd'];

        $pecas = $servicePecas->update($dados);

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