<?php

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 */
class Repartidor {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

  /**
   * @var Sucursal $sucursal
   *
   * @ORM\ManyToOne(targetEntity="Sucursal", inversedBy="repartidores")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Sucursal")
   */
    protected $sucursal;

    /** @ORM\Column(type="string", length=50) */
    protected $nombre;

    /** @ORM\Column(type="string", length=50) */
    protected $apellido;

    /** @ORM\Column(type="string", length=50, nullable=true) */
    protected $telefono;
    
  /**
   * @var ArrayCollection $comandas
   *
   * @ORM\OneToMany(targetEntity="Comanda", mappedBy="repartidor")
   */
    protected $comandas;       

      /**
   * @var datetime $created_at
   *
   * @Gedmo\Timestampable(on="create")
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $created_at;

  /**
   * @var datetime $updated_at
   *
   * @Gedmo\Timestampable(on="update")
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $updated_at; 
   

    public function __toString() {
        return $this->getNombre();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Repartidor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Repartidor
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    
        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Repartidor
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Repartidor
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Repartidor
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set sucursal
     *
     * @param \Administracion\ModeloBundle\Entity\Sucursal $sucursal
     * @return Repartidor
     */
    public function setSucursal(\Administracion\ModeloBundle\Entity\Sucursal $sucursal = null)
    {
        $this->sucursal = $sucursal;
    
        return $this;
    }

    /**
     * Get sucursal
     *
     * @return \Administracion\ModeloBundle\Entity\Sucursal 
     */
    public function getSucursal()
    {
        return $this->sucursal;
    }
    
    public function getNombreCompleto()
    {
        return $this->nombre.' '.$this->apellido;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comandas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add comandas
     *
     * @param \Administracion\ModeloBundle\Entity\Comanda $comandas
     * @return Repartidor
     */
    public function addComanda(\Administracion\ModeloBundle\Entity\Comanda $comandas)
    {
        $this->comandas[] = $comandas;
    
        return $this;
    }

    /**
     * Remove comandas
     *
     * @param \Administracion\ModeloBundle\Entity\Comanda $comandas
     */
    public function removeComanda(\Administracion\ModeloBundle\Entity\Comanda $comandas)
    {
        $this->comandas->removeElement($comandas);
    }

    /**
     * Get comandas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComandas()
    {
        return $this->comandas;
    }
}