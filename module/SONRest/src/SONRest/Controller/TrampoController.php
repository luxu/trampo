<?php

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class TrampoController extends AbstractRestfulController
{

    // get
    public function getList()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Trampo')->findAll();

        return $data;
    }

    // get
    public function get($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Trampo')->find($id);

        return $data;
    }

    // post
    public function create($dados) {

        $serviceTrampo = $this->getServiceLocator()->get('Application\Service\Trampo');

        if(isset($dados['id'])) {
            $trampo = $serviceTrampo->update($dados);
        } else {
            $qtdec = $dados['qtdeec'];
            for ($i=0; $i < $qtdec; $i++) {
                    $trampo = $serviceTrampo->insert($dados);
            }
        }

        if($trampo) {
            return new JsonModel(array('data'=>array('id'=>$trampo->getId(),'success'=>true)));
        } else {
            return new JsonModel(array('data'=>array('success'=>false)));
        }

    }

    // put
    public function update($id, $dados)
    {
        $serviceTrampo = $this->getServiceLocator()->get('Application\Service\Trampo');
        // $param['id'] = $id;
        // $param['data'] = $dados['data'];
        // $param['conclusao'] = $dados['conclusao'];
        // $param['ec'] = $dados['ec'];
        // $param['nroos'] = $dados['nroos'];
        // $param['valor'] = $dados['valor'];

        // $trampo = $serviceTrampo->update($param);
        $trampo = $serviceTrampo->update($dados);

        if($trampo) {
            return $trampo;
        } else {
            return array('success'=>false);
        }
    }

    // delete
    public function delete($id)
    {
        $serviceTrampo = $this->getServiceLocator()->get('Application\Service\Trampo');
        $result = $serviceTrampo->delete($id);
        if($result) return $result;
    }

    public function autocomplete($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Trampo')->find($id);

        /*
            // Prepara o select. Limito para 3 resultado, para não encher a tela de autoajuda
            $query = 'SELECT e.id, e.nome FROM empresas e WHERE e.nome LIKE "%'.$search.'%" LIMIT 0,3';

            if ($result = $con->query($query)) {

            // percorre os resultados
            while ($obj = $result->fetch_object()) {
                    $json[] = array('id_empresa' => $obj->id, 'nome' => $obj->nome);
            }

            $result->close();

            echo json_encode($json);

        */

        return $data;
    }

    public function listarPorTecnologiaAction()  {

        $dados = json_decode(file_get_contents('php://input'),true);

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Trampo')
                                ->listarPorTecnologia($dados);

        return $data;
    }

    public function listarPorDataAction()  {

        $dados = json_decode(file_get_contents('php://input'),true);

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Trampo')
                                ->listarPorData($dados);

        return $data;
    }
}