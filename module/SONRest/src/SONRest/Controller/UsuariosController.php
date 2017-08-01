<?php

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UsuariosController extends AbstractRestfulController
{

    // get
    public function getList()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Usuarios')->findAll();

        return $data;
    }

    // get
    public function get($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Usuarios')->find($id);

        return $data;
    }


    // logar
    public function logar($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Usuarios')->logar($id);

        return $data;
    }

    // post
    public function create($dados)
    {

        $serviceUsuarios = $this->getServiceLocator()->get('Application\Service\Usuarios');

        $usuarios = $serviceUsuarios->insert($dados);

        if($usuarios) {
            return $usuarios;
        } else {
            return array('success'=>false);
        }

    }

    // put
    public function update($id, $dados)
    {
        $serviceUsuarios = $this->getServiceLocator()->get('Application\Service\Usuarios');
        // $param['id'] = $id;
        // $param['data'] = $dados['data'];
        // $param['conclusao'] = $dados['conclusao'];
        // $param['ec'] = $dados['ec'];
        // $param['nroos'] = $dados['nroos'];
        // $param['valor'] = $dados['valor'];

        // $trampo = $serviceUsuarios->update($param);
        $trampo = $serviceUsuarios->update($dados);

        if($trampo) {
            return $trampo;
        } else {
            return array('success'=>false);
        }
    }

    // delete
    public function delete($id)
    {
        $serviceUsuarios = $this->getServiceLocator()->get('Application\Service\Usuarios');
        $result = $serviceUsuarios->delete($id);
        if($result) return $result;
    }

}