<?php

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ItensPecasController extends AbstractRestfulController  {

    // get
    public function get($id)  {

        echo "CHEGOU...";
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        // $data = $em->getRepository('Application\Entity\ItensPecas')->find($id);
        $data = $em->getRepository('Application\Entity\ItensPecas')->getItensPecas($id);
        return $data;
    }

    // post
    public function create($dados) {

        $serviceItensPecas = $this->getServiceLocator()->get('Application\Service\ItensPecas');
        $dados['total'] = $dados['preco'] * $dados['qtd'];

        $ItensPecas = $serviceItensPecas->insert($dados);

       if(isset($dados['id'])) {
           $ItensPecas = $serviceItensPecas->update($dados);
       } else {
           $ItensPecas = $serviceItensPecas->insert($dados);
       }

       if($ItensPecas) {
           return new JsonModel(array('data'=>array('idPecas'=>$ItensPecas->getPecas(),'success'=>true)));
       } else {
           return new JsonModel(array('data'=>array('success'=>false)));
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