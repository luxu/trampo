<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
// use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Application\Entity\PecasRepository")
 * @ORM\Table(name="pecas")
 */
class Pecas {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $data;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $veiculo;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    private $proxtroca;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    private $troca;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $local;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $comercio;

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
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets the value of data.
     *
     * @param mixed $data the data
     *
     * @return self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Gets the value of veiculo.
     *
     * @return string
     */
    public function getVeiculo()
    {
        return $this->veiculo;
    }

    /**
     * Sets the value of veiculo.
     *
     * @param string $veiculo the veiculo
     *
     * @return self
     */
    public function setVeiculo($veiculo)
    {
        $this->veiculo = $veiculo;

        return $this;
    }

    /**
     * Gets the value of proxtroca.
     *
     * @return string
     */
    public function getProxtroca()
    {
        return $this->proxtroca;
    }

    /**
     * Sets the value of proxtroca.
     *
     * @param string $proxtroca the proxtroca
     *
     * @return self
     */
    public function setProxtroca($proxtroca)
    {
        $this->proxtroca = $proxtroca;

        return $this;
    }

    /**
     * Gets the value of troca.
     *
     * @return string
     */
    public function getTroca()
    {
        return $this->troca;
    }

    /**
     * Sets the value of troca.
     *
     * @param string $troca the troca
     *
     * @return self
     */
    public function setTroca($troca)
    {
        $this->troca = $troca;

        return $this;
    }

    /**
     * Gets the value of local.
     *
     * @return string
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Sets the value of local.
     *
     * @param string $local the local
     *
     * @return self
     */
    public function setLocal($local)
    {
        $this->local = $local;

        return $this;
    }

    /**
     * Gets the value of comercio.
     *
     * @return string
     */
    public function getComercio()
    {
        return $this->comercio;
    }

    /**
     * Sets the value of comercio.
     *
     * @param string $comercio the comercio
     *
     * @return self
     */
    public function setComercio($comercio)
    {
        $this->comercio = $comercio;

        return $this;
    }
}