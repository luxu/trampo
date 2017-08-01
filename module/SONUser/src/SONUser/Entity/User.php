<?php

namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\Math\Rand,
        Zend\Crypt\Key\Derivation\Pbkdf2;

use Zend\Stdlib\Hydrator;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="SONUser\Entity\UserRepository")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=false)
     */
    private $activationKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /*
    * Construtor da classe User.php
    */
    public function __construct(array $options = array()){

        // $hydrator = new Hydrator\ClassMethods;
        // $hydrator->hydrate($options, $this);

        (new Hydrator\ClassMethods)->hydrate($options,$this);

        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");

        $this->salt = base64_encode(Rand::getBytes(8, true));
        $this->activationKey = md5($this->email.$this->salt);
        // echo "e-Mail.:  " . $this->email . "<br />";
        // echo "salt.:  " . $this->salt . "<br />";
        // echo "activationKey.:  " . $this->activationKey . "<br />";
        // echo "<pre>";var_dump($options);
        // echo "<pre>";var_dump($hydrator->hydrate($options, $this));die;

    }

    /**
     * Gets the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param integer $id the id
     *
     * @return self
     */
    public function setId($id)
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
    public function setNome($nome)
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
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the value of password.
     *
     * @param string $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $this->encryptPassword($password);
        return $this;
    }

    public function encryptPassword($password) {

        return base64_encode(Pbkdf2::calc('sha256', $password, $this->salt, 10000, strlen($password*2)));
    }

    /**
     * Gets the value of salt.
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Sets the value of salt.
     *
     * @param string $salt the salt
     *
     * @return self
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Gets the value of active.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Sets the value of active.
     *
     * @param boolean $active the active
     *
     * @return self
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Gets the value of activationKey.
     *
     * @return string
     */
    public function getActivationKey()
    {
        return $this->activationKey;
    }

    /**
     * Sets the value of activationKey.
     *
     * @param string $activationKey the activation key
     *
     * @return self
     */
    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;

        return $this;
    }

    /**
     * Gets the value of updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\prePersist
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime("now");

        return $this;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets the value of createdAt.
     *
     * @param \DateTime $createdAt the created at
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = new \DateTime("now");

        return $this;
    }

    public function toArray() {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}
