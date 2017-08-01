<?php

namespace Application\Entity;

use Doctrine\ORM\EntityRepository;

class ItensPecasRepository extends EntityRepository {

    public function getItensPecas($id) {

        $sql = "SELECT i FROM Application\Entity\ItensPecas i WHERE i.pecas = " . $id;
        $result = $this->getEntityManager()->createQuery($sql)->getResult();

        if ($result) return  $result;
        else return false;

    }
}