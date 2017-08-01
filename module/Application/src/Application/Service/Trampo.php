<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Trampo as TrampoEntity;

class Trampo
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert($dados)
    {
        $trampoEntity = new TrampoEntity;
        $date = new \DateTime($dados['data']);
        $trampoEntity->setData($date);
        $trampoEntity->setConclusao($dados['conclusao']);
        $trampoEntity->setEc($dados['ec']);
        $trampoEntity->setNroos($dados['nroos']);
        isset($dados['obs'])?$trampoEntity->setObs($dados['obs']):$trampoEntity->setObs(null);
        $valor = $this->soNumero($dados['conclusao']);
        $trampoEntity->setValor($valor);

        $this->em->persist($trampoEntity);
        $this->em->flush();

        return $trampoEntity;
    }

    public function update(array $dados)
    {
        $trampoEntity = $this->em
            ->getReference('Application\Entity\Trampo', $dados['id']);

        $date = new \DateTime($dados['data']);
        $trampoEntity->setData($date);
        $trampoEntity->setConclusao($dados['conclusao']);
        $trampoEntity->setEc($dados['ec']);
        $trampoEntity->setNroos($dados['nroos']);
        isset($dados['obs'])?$trampoEntity->setObs($dados['obs']):$trampoEntity->setObs(null);
        $valor = $this->soNumero($dados['conclusao']);
        $trampoEntity->setValor($valor);

        $this->em->persist($trampoEntity);
        $this->em->flush();

        return $trampoEntity;
    }

    public function delete($id)
    {
        $trampoEntity = $this->em
            ->getReference('Application\Entity\Trampo', $id);

        $this->em->remove($trampoEntity);
        $this->em->flush();
        return $id;
    }

    public function soNumero($str) {
        return preg_replace("/[^1-9]/", "", $str);
    }

}