<?php

namespace Application\Entity;

use Doctrine\ORM\EntityRepository;

class UsuariosRepository extends EntityRepository {

	public function logar($user)  {

		$username = $user.username;
		$password = $user.password;

	    	$sql = "SELECT t FROM Application\Entity\Trampo t WHERE t.nome = $username , t.senha = $password" ;

	    return $this->getEntityManager()->createQuery($sql)->getResult();
	}
}