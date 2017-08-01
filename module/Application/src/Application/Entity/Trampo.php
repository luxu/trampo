<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Entity\TrampoRepository")
 * @ORM\Table(name="trampo")
 */
class Trampo {
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
    private $ec;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    private $nroos;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $conclusao;

    /**
     * @ORM\Column(type="decimal", precision=2, scale=1)
     * @var decimal
     */
    private $valor;

    /**
     * @ORM\Column(type="text")
     * @var text
     */
    private $obs;

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
     * Gets the value of ec.
     *
     * @return string
     */
    public function getEc()
    {
        return $this->ec;
    }

    /**
     * Sets the value of ec.
     *
     * @param string $ec the ec
     *
     * @return self
     */
    public function setEc($ec)
    {
        $this->ec = $ec;

        return $this;
    }

    /**
     * Gets the value of nroos.
     *
     * @return string
     */
    public function getNroos()
    {
        return $this->nroos;
    }

    /**
     * Sets the value of nroos.
     *
     * @param string $nroos the nroos
     *
     * @return self
     */
    public function setNroos($nroos)
    {
        $this->nroos = $nroos;

        return $this;
    }

    /**
     * Gets the value of conclusao.
     *
     * @return string
     */
    public function getConclusao()
    {
        return $this->conclusao;
    }

    /**
     * Sets the value of conclusao.
     *
     * @param string $conclusao the conclusao
     *
     * @return self
     */
    public function setConclusao($conclusao)
    {
        $this->conclusao = $conclusao;

        return $this;
    }

    /**
     * Gets the value of valor.
     *
     * @return decimal
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Sets the value of valor.
     *
     * @param decimal $valor the valor
     *
     * @return self
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Gets the value of obs.
     *
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * Sets the value of obs.
     *
     * @param string $obs the obs
     *
     * @return self
     */
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }
}