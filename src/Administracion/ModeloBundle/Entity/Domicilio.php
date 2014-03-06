<?php 

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;
/**
* @ORM\Entity
*/

class Domicilio
{
/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue
*/
protected $id;

  /**
   * @var Cliente $cliente
   *
   * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="domicilios")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   */
protected $cliente;

/** @ORM\Column(type="string", length=150) */
protected $calle;

/** @ORM\Column(type="integer", nullable =true) */
protected $numero;

/** @ORM\Column(type="string", nullable = true) */
protected $esquina;

/** @ORM\Column(type="string", length=80, nullable = true) */
protected $localidad;

/** @ORM\Column(type="string", nullable = true) */
protected $piso;

/** @ORM\Column(type="string", nullable = true) */
protected $departamento;

  /**
   * @var decimal $latitud
   *
   * @ORM\Column(type="decimal", precision=20, scale = 17, nullable=true)
   */
  protected $latitud;

  /**
   * @var decimal $longitud
   *
   * @ORM\Column(type="decimal", precision=20, scale = 17, nullable=true)
   */
  protected $longitud;

/** @ORM\Column(type="text", nullable = true) */
protected $comentario;

  /**
   * @var ArrayCollection $comandas
   *
   * @ORM\OneToMany(targetEntity="Comanda", mappedBy="domicilio")
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
     * Set calle
     *
     * @param string $calle
     * @return Domicilio
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    
        return $this;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Domicilio
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set esquina
     *
     * @param integer $esquina
     * @return Domicilio
     */
    public function setEsquina($esquina)
    {
        $this->esquina = $esquina;
    
        return $this;
    }

    /**
     * Get esquina
     *
     * @return integer 
     */
    public function getEsquina()
    {
        return $this->esquina;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     * @return Domicilio
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    
        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set piso
     *
     * @param string $piso
     * @return Domicilio
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
    
        return $this;
    }

    /**
     * Get piso
     *
     * @return string 
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * Set departamento
     *
     * @param string $departamento
     * @return Domicilio
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    
        return $this;
    }

    /**
     * Get departamento
     *
     * @return string 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Domicilio
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    
        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Domicilio
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
     * @return Domicilio
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
     * Set cliente
     *
     * @param \Administracion\ModeloBundle\Entity\Cliente $cliente
     * @return Domicilio
     */
    public function setCliente(\Administracion\ModeloBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Administracion\ModeloBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set latitud
     *
     * @param float $latitud
     * @return Domicilio
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    
        return $this;
    }

    /**
     * Get latitud
     *
     * @return float 
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param float $longitud
     * @return Domicilio
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    
        return $this;
    }

    /**
     * Get longitud
     *
     * @return float 
     */
    public function getLongitud()
    {
        return $this->longitud;
    }
    
    public function getPisoDepartamento()
    {
        if($this->piso && $this->departamento)
            return '- Piso '.$this->piso.' - Dpto '.$this->departamento;
        if($this->piso)
             return '- Piso '.$this->piso; 
        if($this->departamento)
             return '- Piso '.$this->departamento;        
    }
    
    public function getEsquinaLocalidad()
    {
        if($this->esquina && $this->localidad)
            return  'Esquina '.$this->esquina.' - '.$this->localidad;
        if($this->localidad)
            return  $this->localidad;   
        if($this->esquina)
            return  'Esquina '.$this->esquina;            
            
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
     * @return Domicilio
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