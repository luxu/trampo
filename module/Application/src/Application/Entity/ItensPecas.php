<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
// use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Application\Entity\ItensPecasRepository")
 * @ORM\Table(name="itens_pecas")
 */
class ItensPecas {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Pecas")
     * @ORM\JoinColumn(name="pecas_id", referencedColumnName="id")
     */
    private $pecas;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $descricao;

    /**
     * @ORM\Column(type="decimal")
     * @var string
     */
    private $preco;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    private $qtd;

    /**
     * @ORM\Column(type="decimal")
     * @var string
     */
    private $total;

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
     * Gets the value of pecas.
     *
     * @return mixed
     */
    public function getPecas()
    {
        return $this->pecas;
    }

    /**
     * Sets the value of pecas.
     *
     * @param mixed $pecas the pecas
     *
     * @return self
     */
    public function setPecas(Pecas $pecas)
    {
        $this->pecas = $pecas;

        return $this;
    }

    /**
     * Gets the value of descricao.
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Sets the value of descricao.
     *
     * @param string $descricao the descricao
     *
     * @return self
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Gets the value of preco.
     *
     * @return string
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Sets the value of preco.
     *
     * @param string $preco the preco
     *
     * @return self
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    /**
     * Gets the value of qtd.
     *
     * @return string
     */
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * Sets the value of qtd.
     *
     * @param string $qtd the qtd
     *
     * @return self
     */
    public function setQtd($qtd)
    {
        $this->qtd = $qtd;

        return $this;
    }

    /**
     * Gets the value of total.
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Sets the value of total.
     *
     * @param string $total the total
     *
     * @return self
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
}