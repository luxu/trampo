<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Entity\VeiculoRepository")
 * @ORM\Table(name="veiculo")
 */
class Veiculo {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @var string
     */
    private $data;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $veiculo;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $kminicial;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $kmfinal;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $distanciapercorrida;

    /**
     * @ORM\Column(type="decimal")
     * @var decimal
     */
    private $litrosabastecidos;

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
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets the value of data.
     *
     * @param string $data the data
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
     * Gets the value of kminicial.
     *
     * @return int
     */
    public function getKminicial()
    {
        return $this->kminicial;
    }

    /**
     * Sets the value of kminicial.
     *
     * @param int $kminicial the kminicial
     *
     * @return self
     */
    public function setKminicial($kminicial)
    {
        $this->kminicial = $kminicial;

        return $this;
    }

    /**
     * Gets the value of kmfinal.
     *
     * @return int
     */
    public function getKmfinal()
    {
        return $this->kmfinal;
    }

    /**
     * Sets the value of kmfinal.
     *
     * @param int $kmfinal the kmfinal
     *
     * @return self
     */
    public function setKmfinal($kmfinal)
    {
        $this->kmfinal = $kmfinal;

        return $this;
    }

    /**
     * Gets the value of distanciapercorrida.
     *
     * @return int
     */
    public function getDistanciapercorrida()
    {
        return $this->distanciapercorrida;
    }

    /**
     * Sets the value of distanciapercorrida.
     *
     * @param int $distanciapercorrida the distanciapercorrida
     *
     * @return self
     */
    public function setDistanciapercorrida($distanciapercorrida)
    {
        $this->distanciapercorrida = $distanciapercorrida;

        return $this;
    }

    /**
     * Gets the value of litrosabastecidos.
     *
     * @return decimal
     */
    public function getLitrosabastecidos()
    {
        return $this->litrosabastecidos;
    }

    /**
     * Sets the value of litrosabastecidos.
     *
     * @param decimal $litrosabastecidos the litrosabastecidos
     *
     * @return self
     */
    public function setLitrosabastecidos($litrosabastecidos)
    {
        $this->litrosabastecidos = $litrosabastecidos;

        return $this;
    }
}