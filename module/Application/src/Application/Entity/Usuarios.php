<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Entity\UsuariosRepository")
 * @ORM\Table(name="usuarios")
 */
class Usuarios {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @var string
    */
    private $nome;

    /**
     * @ORM\Column(type="text")
     * @var string
    */
    private $email;

    /**
     * @ORM\Column(type="text")
     * @var string
    */
    private $login;

    /**
     * @ORM\Column(type="text")
     * @var string
    */
    private $senha;

    /**
     * @ORM\Column(type="text")
     * @var string
    */
    private $nivel;

    /**
     * Gets the value of id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param int $id the id
     *
     * @return self
     */
    private function _setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param string $nome the nome
     *
     * @return self
     */
    private function _setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param string $email the email
     *
     * @return self
     */
    private function _setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param string $login the login
     *
     * @return self
     */
    private function _setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of senha.
     *
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Sets the value of senha.
     *
     * @param string $senha the senha
     *
     * @return self
     */
    private function _setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Gets the value of nivel.
     *
     * @return string
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Sets the value of nivel.
     *
     * @param string $nivel the nivel
     *
     * @return self
     */
    private function _setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }
}