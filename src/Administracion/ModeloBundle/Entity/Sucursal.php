<?php

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 */
class Sucursal {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string", length=50) */
    protected $nombre;

    /** @ORM\Column(type="string", length=100) */
    protected $domicilio;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $telefono;

    /** @ORM\Column(type="integer", nullable=true) */
    protected $estado;
    
  /**
   * @var ArrayCollection $repartidores
   *
   * @ORM\OneToMany(targetEntity="Repartidor", mappedBy="sucursal")
   */
    protected $repartidores;   
    
  /**
   * @var ArrayCollection $usuarios
   *
   * @ORM\OneToMany(targetEntity="Usuario", mappedBy="sucursal")
   */
    protected $usuarios;      
    
  /**
   * @var ArrayCollection $clientes
   *
   * @ORM\OneToMany(targetEntity="Usuario", mappedBy="sucursal")
   */
    protected $clientes;     
    
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
     * @return Sucursal
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
     * Set domicilio
     *
     * @param string $domicilio
     * @return Sucursal
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    
        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Sucursal
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
     * Set estado
     *
     * @param integer $estado
     * @return Sucursal
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Sucursal
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
     * @return Sucursal
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
     * Constructor
     */
    public function __construct()
    {
        $this->repartidores = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add repartidores
     *
     * @param \Administracion\ModeloBundle\Entity\Repartidor $repartidores
     * @return Sucursal
     */
    public function addRepartidore(\Administracion\ModeloBundle\Entity\Repartidor $repartidores)
    {
        $this->repartidores[] = $repartidores;
    
        return $this;
    }

    /**
     * Remove repartidores
     *
     * @param \Administracion\ModeloBundle\Entity\Repartidor $repartidores
     */
    public function removeRepartidore(\Administracion\ModeloBundle\Entity\Repartidor $repartidores)
    {
        $this->repartidores->removeElement($repartidores);
    }

    /**
     * Get repartidores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRepartidores()
    {
        return $this->repartidores;
    }

    /**
     * Add usuarios
     *
     * @param \Administracion\ModeloBundle\Entity\Usuario $usuarios
     * @return Sucursal
     */
    public function addUsuario(\Administracion\ModeloBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;
    
        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \Administracion\ModeloBundle\Entity\Usuario $usuarios
     */
    public function removeUsuario(\Administracion\ModeloBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add clientes
     *
     * @param \Administracion\ModeloBundle\Entity\Usuario $clientes
     * @return Sucursal
     */
    public function addCliente(\Administracion\ModeloBundle\Entity\Usuario $clientes)
    {
        $this->clientes[] = $clientes;
    
        return $this;
    }

    /**
     * Remove clientes
     *
     * @param \Administracion\ModeloBundle\Entity\Usuario $clientes
     */
    public function removeCliente(\Administracion\ModeloBundle\Entity\Usuario $clientes)
    {
        $this->clientes->removeElement($clientes);
    }

    /**
     * Get clientes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientes()
    {
        return $this->clientes;
    }
}