<?php

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Administracion\ModeloBundle\Entity\ClienteRepository")
 */
class Cliente {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /** @ORM\Column(type="string", length=50, unique=true) */
    protected $codigo;    

    /** @ORM\Column(type="string", length=50, nullable=true) */
    protected $nombre;

    /** @ORM\Column(type="string", length=50, nullable=true) */
    protected $apellido;

    /** @ORM\Column(type="string", length=100, nullable = true) */
    protected $email;

    /** @ORM\Column(type="date", length=20, nullable = true) */
    protected $cumple;

    /** @ORM\Column(type="text", nullable = true) */
    protected $comentarios;
    
      /**
   * @var Sucursal $sucursal
   *
   * @ORM\ManyToOne(targetEntity="Sucursal", inversedBy="clientes")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade", nullable=true)
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Sucursal")
   */
    protected $sucursal;   
    
  /**
   * @var ArrayCollection $comandas
   *
   * @ORM\OneToMany(targetEntity="Comanda", mappedBy="cliente")
   */
    protected $comandas;  
    
  /**
   * @var ArrayCollection $domicilios
   *
   * @ORM\OneToMany(targetEntity="Domicilio", mappedBy="cliente")
   */
    protected $domicilios;    
    
  /**
   * @var ArrayCollection $telefonos
   *
   * @ORM\OneToMany(targetEntity="Telefono", mappedBy="cliente")
   */
    protected $telefonos;       
    
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
     * Set codigo
     *
     * @param string $codigo
     * @return Cliente
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Cliente
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
     * @return Cliente
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
     * Set email
     *
     * @param string $email
     * @return Cliente
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set cumple
     *
     * @param \DateTime $cumple
     * @return Cliente
     */
    public function setCumple($cumple)
    {
        $this->cumple = $cumple;
    
        return $this;
    }

    /**
     * Get cumple
     *
     * @return \DateTime 
     */
    public function getCumple()
    {
        return $this->cumple;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     * @return Cliente
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
    
        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Cliente
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
     * @return Cliente
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
        $this->comandas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->domicilios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->telefonos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add comandas
     *
     * @param \Administracion\ModeloBundle\Entity\Comanda $comandas
     * @return Cliente
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

    /**
     * Add domicilios
     *
     * @param \Administracion\ModeloBundle\Entity\Domicilio $domicilios
     * @return Cliente
     */
    public function addDomicilio(\Administracion\ModeloBundle\Entity\Domicilio $domicilios)
    {
        $this->domicilios[] = $domicilios;
    
        return $this;
    }

    /**
     * Remove domicilios
     *
     * @param \Administracion\ModeloBundle\Entity\Domicilio $domicilios
     */
    public function removeDomicilio(\Administracion\ModeloBundle\Entity\Domicilio $domicilios)
    {
        $this->domicilios->removeElement($domicilios);
    }

    /**
     * Get domicilios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDomicilios()
    {
        return $this->domicilios;
    }

    /**
     * Add telefonos
     *
     * @param \Administracion\ModeloBundle\Entity\Telefono $telefonos
     * @return Cliente
     */
    public function addTelefono(\Administracion\ModeloBundle\Entity\Telefono $telefonos)
    {
        $this->telefonos[] = $telefonos;
    
        return $this;
    }

    /**
     * Remove telefonos
     *
     * @param \Administracion\ModeloBundle\Entity\Telefono $telefonos
     */
    public function removeTelefono(\Administracion\ModeloBundle\Entity\Telefono $telefonos)
    {
        $this->telefonos->removeElement($telefonos);
    }

    /**
     * Get telefonos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }
    
    public function getNombreCompleto()
    {
        return $this->nombre.' '.$this->apellido;
    }  
    
    public function getPrimerTelefono()
    {       
        return count($this->telefonos) > 0 ? $this->telefonos[0] : null;
    }
    
    public function getPrimerDomicilio($domicilio_id = null)
    {      
        if($domicilio_id)
        {
            foreach($this->domicilios as $domicilio)
                if($domicilio->getId() == $domicilio_id)
                    return $domicilio;
        }
        return count($this->domicilios) > 0 ? $this->domicilios[0] : null;
    } 
    
    public function getPrimeraLatitud()
    {       
        return count($this->domicilios) > 0 ? $this->domicilios[0]->getLatitud() : null;
    }   
    
    public function getPrimeraLongitud()
    {       
        return count($this->domicilios) > 0 ? $this->domicilios[0]->getLongitud() : null;
    }     

    /**
     * Set sucursal
     *
     * @param \Administracion\ModeloBundle\Entity\Sucursal $sucursal
     * @return Cliente
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
}