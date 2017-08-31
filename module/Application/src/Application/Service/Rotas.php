<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Rotas as RotasEntity;

class Rotas
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert($dados)  {

        // echo "<pre>";
        // var_dump($dados);die;

        if(!$dados['id']) {

            $rotasEntity = new RotasEntity;

            $date = new \DateTime($dados['data']);
            $saida = $dados['saidahr']['hora'] .":". $dados['saidamin']['minuto'];
            $chegada = $dados['chegadahr']['hora'] . ":" .$dados['chegadamin']['minuto'];
            $tempo = $this->intervalo( $chegada, $saida );
            $convertSaida = date( 'H:i', strtotime($saida));
            $convertChegada = date( 'H:i', strtotime($chegada));

            $rotasEntity->setData($date);
            $rotasEntity->setHrchegada($convertChegada);
            $rotasEntity->setHrsaida($convertSaida);
            $rotasEntity->setCiddestino($dados['ciddestino']);
            $rotasEntity->setCidorigem($dados['cidorigem']);
            $rotasEntity->setKminicial($dados['kminicial']);
            $rotasEntity->setKmfinal($dados['kmfinal']);
            $dist = $rotasEntity->getKmfinal() - $rotasEntity->getKminicial();
            $rotasEntity->setDistancia($dist);
            $rotasEntity->setTempo($tempo);
            isset($dados['obs'])?$rotasEntity->setObs($dados['obs']):$rotasEntity->setObs(null);

        } else {
            $rotasEntity = $this->em
                ->getReference('Application\Entity\Rotas', $dados['id']);

        }

        $this->em->persist($rotasEntity);
        $this->em->flush();

        return $rotasEntity;
    }

    public function intervalo( $chegada, $saida ) {

       $chegada = explode( ':', $chegada );
       $saida   = explode( ':', $saida );
       $minutos = ( $saida[0] - $chegada[0] ) * 60 + $saida[1] - $chegada[1];
       $minutos = ( $chegada[0] - $saida[0] ) * 60 + $chegada[1] - $saida[1];
       if( $minutos < 0 ) $minutos += 24 * 60;
       return sprintf( '%d:%d', $minutos / 60, $minutos % 60 );
    }

    public function update(array $dados)
    {
        $rotasEntity = $this->em
            ->getReference('Application\Entity\Rotas', $dados['id']);

        $date = new \DateTime($dados['data']);
        $rotasEntity->setData($date);
        $rotasEntity->setConclusao($dados['conclusao']);
        $rotasEntity->setEc($dados['ec']);
        $rotasEntity->setNroos($dados['nroos']);
        isset($dados['obs'])?$rotasEntity->setObs($dados['obs']):$rotasEntity->setObs(null);
        $valor = $this->soNumero($dados['conclusao']);
        $rotasEntity->setValor($valor);

        $this->em->persist($rotasEntity);
        $this->em->flush();

        return $rotasEntity;
    }

    public function delete($id) {

        $rotasEntity = $this->em
            ->getReference('Application\Entity\Rotas', $id);

        $this->em->remove($rotasEntity);
        $this->em->flush();
        return $id;
    }

}