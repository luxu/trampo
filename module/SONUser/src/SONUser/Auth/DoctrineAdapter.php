<?php

namespace SONUser\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;

use Doctrine\ORM\EntityManager;

class DoctrineAdapter implements AdapterInterface {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    protected $login;
    protected $senha;
    // protected $username;
    // protected $password;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param mixed $login the login
     *
     * @return self
     */
    protected function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of senha.
     *
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Sets the value of senha.
     *
     * @param mixed $senha the senha
     *
     * @return self
     */
    protected function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $repository = $this->em->getRepository('SONUser\Entity\User');
        $user = $repository->findOneBy(array('username'=>$this->getUsername(), 'password'=>$this->getPassword()));

        if($user) {
            return new Result(Result::SUCCESS, array('user'=>$user), array('OK'));
        } else {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
        }
    }

}