<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Entity\RotasRepository")
 * @ORM\Table(name="rotas")
 */
class Rotas {

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
    private $cidorigem;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $ciddestino;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $hrsaida;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $hrchegada;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    private $kminicial;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    private $kmfinal;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    private $distancia;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $tempo;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $obs;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
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
     * @return string
     */
    public function getCidorigem()
    {
        return $this->cidorigem;
    }

    /**
     * @param string $cidorigem
     *
     * @return self
     */
    public function setCidorigem($cidorigem)
    {
        $this->cidorigem = $cidorigem;

        return $this;
    }

    /**
     * @return string
     */
    public function getCiddestino()
    {
        return $this->ciddestino;
    }

    /**
     * @param string $ciddestino
     *
     * @return self
     */
    public function setCiddestino($ciddestino)
    {
        $this->ciddestino = $ciddestino;

        return $this;
    }

    /**
     * @return string
     */
    public function getHrsaida()
    {
        return $this->hrsaida;
    }

    /**
     * @param string $hrsaida
     *
     * @return self
     */
    public function setHrsaida($hrsaida)
    {
        $this->hrsaida = $hrsaida;

        return $this;
    }

    /**
     * @return string
     */
    public function getHrchegada()
    {
        return $this->hrchegada;
    }

    /**
     * @param string $hrchegada
     *
     * @return self
     */
    public function setHrchegada($hrchegada)
    {
        $this->hrchegada = $hrchegada;

        return $this;
    }

    /**
     * @return string
     */
    public function getKminicial()
    {
        return $this->kminicial;
    }

    /**
     * @param string $kminicial
     *
     * @return self
     */
    public function setKminicial($kminicial)
    {
        $this->kminicial = $kminicial;

        return $this;
    }

    /**
     * @return string
     */
    public function getKmfinal()
    {
        return $this->kmfinal;
    }

    /**
     * @param string $kmfinal
     *
     * @return self
     */
    public function setKmfinal($kmfinal)
    {
        $this->kmfinal = $kmfinal;

        return $this;
    }

    /**
     * @return string
     */
    public function getDistancia()
    {
        return $this->distancia;
    }

    /**
     * @param string $distancia
     *
     * @return self
     */
    public function setDistancia($distancia)
    {
        $this->distancia = $distancia;

        return $this;
    }

    /**
     * @return string
     */
    public function getTempo()
    {
        return $this->tempo;
    }

    /**
     * @param string $tempo
     *
     * @return self
     */
    public function setTempo($tempo)
    {
        $this->tempo = $tempo;

        return $this;
    }

    /**
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * @param string $obs
     *
     * @return self
     */
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }
}