<?php

namespace Application\Entity;

use Doctrine\ORM\EntityRepository;

class PecasRepository extends EntityRepository {

    public function findAll(){

            return $this->getEntityManager()
                        ->createQuery(
                            "SELECT p FROM Application\Entity\Pecas p
                                ORDER BY p.data DESC"
                        )
                        ->getResult();
        }

}