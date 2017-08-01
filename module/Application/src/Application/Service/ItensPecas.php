<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\ItensPecas as ItensPecasEntity;

class ItensPecas {

    private $em;

    public function __construct(EntityManager $em) {

        $this->em = $em;
    }

    public function insert($dados) {

        $pecasEntity = new ItensPecasEntity;

        $pecas = $this->em->getRepository('Application\Entity\Pecas')->find($dados['idPecas']);

        $pecasEntity->setDescricao($dados['descricao']);
        $pecasEntity->setPecas($pecas);
        $pecasEntity->setPreco($dados['preco']);
        $pecasEntity->setQtd($dados['qtd']);
        $pecasEntity->setTotal($dados['total']);

        $this->em->persist($pecasEntity);
        $this->em->flush();

        return $pecasEntity;
    }

    public function update(array $dados) {

        $pecasEntity = $this->em
                                            ->getReference('Application\Entity\ItensPecas', $dados['idpecas']);

        $pecasEntity->setDescricao($dados['descricao']);
        $pecasEntity->setPecas($pecas);
        $pecasEntity->setPreco($dados['preco']);
        $pecasEntity->setQtd($dados['qtd']);
        $pecasEntity->setTotal($dados['total']);

        $this->em->persist($pecasEntity);
        $this->em->flush();

        return $pecasEntity;
    }

    public function delete($idpecas)
    {
        $pecasEntity = $this->em
            ->getReference('Application\Entity\ItensPecas', $idpecas);

        $this->em->remove($pecasEntity);
        $this->em->flush();
        return $idpecas;
    }

}