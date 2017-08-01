<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Pecas as PecasEntity;

class Pecas
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert($dados)
    {
        $pecasEntity = new PecasEntity;
        $date = new \DateTime($dados['data']);
        $pecasEntity->setData($date);
        $pecasEntity->setVeiculo($dados['veiculo']);
        $pecasEntity->setProxTroca($dados['proxtroca']);
        $pecasEntity->setTroca($dados['troca']);
        $pecasEntity->setLocal($dados['local']);
        $pecasEntity->setComercio($dados['comercio']);

        $this->em->persist($pecasEntity);
        $this->em->flush();

        return $pecasEntity;
    }

    public function update(array $dados)
    {
        $pecasEntity = $this->em
            ->getReference('Application\Entity\Pecas', $dados['idpecas']);

        $date = new \DateTime($dados['data']);
        $pecasEntity->setData($date);
        $pecasEntity->setVeiculo($dados['veiculo']);
        $pecasEntity->setProxTroca($dados['proxtroca']);
        $pecasEntity->setTroca($dados['troca']);
        $pecasEntity->setLocal($dados['local']);
        $pecasEntity->setComercio($dados['comercio']);

        $this->em->persist($pecasEntity);
        $this->em->flush();

        return $pecasEntity;
    }

    public function delete($idpecas)
    {
        $pecasEntity = $this->em
            ->getReference('Application\Entity\Pecas', $idpecas);

        $this->em->remove($pecasEntity);
        $this->em->flush();
        return $idpecas;
    }

}