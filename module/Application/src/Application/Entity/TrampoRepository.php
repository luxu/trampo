<?php

namespace Application\Entity;

use Doctrine\ORM\EntityRepository;

class TrampoRepository extends EntityRepository {

    public function findAll(){
        return $this->getEntityManager()
                    ->createQuery(
                        "SELECT u FROM Application\Entity\Trampo u
                            where u.data > '2017-01-01' ORDER BY u.id DESC"
                    )->getResult();
    }

    public function listarPorTecnologia($dados)  {

        $tipo = $dados['tipo'];
        $consulta = $dados['dados'];
        if ($consulta === "GET" ||
            $consulta === "CIELO" ||
            $consulta === "STONE" ||
            $consulta === "ELAVON") {

            $sql = "SELECT u FROM Application\Entity\Trampo u WHERE  u.conclusao like '%$consulta%' and u.data > '2017-01-01' ORDER BY u.data DESC";
        } else {
            $sql = "SELECT u FROM Application\Entity\Trampo u WHERE  u.data > '2017-01-01' ORDER BY u.data DESC";
        }

        return $this->getEntityManager()->createQuery($sql)->getResult();
    }

    public function listarPorData($dados)  {

       $consulta1 = "";
       $consulta2 = "";
        foreach ($dados as $dado) {
                    $consulta = strtoupper($dado["item"][0]["name"]);
                    if(isset($dado["item"][1]["name"])) {
                        $consulta1 = $dado["item"][1]["name"];
                    }
                    if(isset($dado["item"][2]["name"])) {
                        $consulta2 = $dado["item"][2]["name"];
                    }
                    $Inicial  = new \DateTime($dado['dtInicial']);
                    $dtInicial  = $Inicial->format('Y-m-d');
                    $Final   = new \DateTime($dado['dtFinal']);
                    $dtFinal   = $Final->format('Y-m-d');
        }

        if ($consulta === "GET" || $consulta === "CIELO" || $consulta === "STONE" || $consulta === "ELAVON") {
            $sql = "SELECT u FROM Application\Entity\Trampo u WHERE  u.conclusao like '%$consulta%' or u.conclusao like '%$consulta1%' or u.conclusao like '%$consulta2%' and u.data between '$dtInicial' and '$dtFinal' ORDER BY u.data DESC";
        } else if ($consulta === "TODOS"){
            $sql = "SELECT u FROM Application\Entity\Trampo u WHERE  u.data between '$dtInicial' and '$dtFinal' ORDER BY u.data DESC";
        } else {
            return 0;
        }

        return $this->getEntityManager()->createQuery($sql)->getResult();
    }

    public function gerarpdf($dataInicial,$dataFinal)  {

        if ($dataInicial instanceof DateTime ) {
            $inicial = $dataInicial;
            $final = $dataFinal;
            $string = explode("-",$inicial);
            $dataInicial = $string[0] . "-" . $string[1] . "-" . $string[2];
            $string = explode("-",$final);
            $dataFinal = $string[0] . "-" . $string[1] . "-" . $string[2];
        }

        // $Inicial  = new \DateTime($dataInicial);
        // $dtInicial  = $Inicial->format('Y-m-d');
        // $Final   = new \DateTime($dataFinal);
        // $dtFinal   = $Final->format('Y-m-d');

        $sql = "SELECT u FROM Application\Entity\Trampo u WHERE  u.data between '$dataInicial' and '$dataFinal' ORDER BY u.nroos ASC";
        return $this->getEntityManager()->createQuery($sql)->getResult();
    }
}