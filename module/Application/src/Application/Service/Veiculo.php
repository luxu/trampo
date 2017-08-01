<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Veiculo as VeiculoEntity;

class Veiculo
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert($dados)
    {
        $veiculoEntity = new VeiculoEntity;
        $date = new \DateTime($dados['data']);
        $veiculoEntity->setData($date);
        $veiculoEntity->setVeiculo($dados['veiculo']);
        $veiculoEntity->setKminicial($dados['kminicial']);
        $veiculoEntity->setKmfinal($dados['kmfinal']);
        $veiculoEntity->setDistanciapercorrida($dados['distanciapercorrida']);
        $veiculoEntity->setLitrosabastecidos($dados['litrosabastecidos']);

        $this->em->persist($veiculoEntity);
        $this->em->flush();

        return $veiculoEntity;
    }

    public function update(array $dados)
    {
        $veiculoEntity = $this->em
            ->getReference('Application\Entity\Veiculo', $dados['id']);

        $date = new \DateTime($dados['data']);
        $veiculoEntity->setData($date);
        $veiculoEntity->setConclusao($dados['conclusao']);
        $veiculoEntity->setEc($dados['ec']);
        $veiculoEntity->setNroos($dados['nroos']);
        isset($dados['obs'])?$veiculoEntity->setObs($dados['obs']):$veiculoEntity->setObs(null);
        $valor = $this->soNumero($dados['conclusao']);
        $veiculoEntity->setValor($valor);

        $this->em->persist($veiculoEntity);
        $this->em->flush();

        return $veiculoEntity;
    }

    public function delete($id)
    {
        $veiculoEntity = $this->em
            ->getReference('Application\Entity\Veiculo', $id);

        $this->em->remove($veiculoEntity);
        $this->em->flush();
        return $id;
    }

    public function soNumero($str) {
        return preg_replace("/[^1-9]/", "", $str);
    }

}