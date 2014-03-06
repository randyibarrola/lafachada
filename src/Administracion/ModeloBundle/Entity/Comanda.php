<?php

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Administracion\ModeloBundle\Entity\ComandaRepository")* 
 */
class Comanda {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

  /**
   * @var Cliente $cliente
   *
   * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="comandas")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Cliente")
   */
    protected $cliente;

    /** @ORM\Column(type="integer", nullable=true) */
    protected $unidades;

    /** @ORM\Column(type="decimal", scale=2, nullable=true) */
    protected $precio;
    
    /** @ORM\Column(type="string", length=30) */
    protected $codigo;    

    /** @ORM\Column(type="string", length=30, nullable=true) */
    protected $tiempo_demora;

    /** @ORM\Column(type="decimal",scale=2, nullable = true) */
    protected $descuento;

    /** @ORM\Column(type="text", nullable = true) */
    protected $comentario;
	
   /**
   * @var Repartidor $repartidor
   *
   * @ORM\ManyToOne(targetEntity="Repartidor", inversedBy="comandas")
   * @ORM\JoinColumn(nullable=true, onDelete="set null")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Repartidor")
   */
    protected $repartidor;
    
   /**
   * @var Domicilio $domicilio
   *
   * @ORM\ManyToOne(targetEntity="Domicilio", inversedBy="comandas")
   * @ORM\JoinColumn(nullable=true, onDelete="set null")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Domicilio")
   */
    protected $domicilio;    
	
	  /**
   * @var Sucursal $sucursal
   *
   * @ORM\ManyToOne(targetEntity="Sucursal", inversedBy="repartidores")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Sucursal")
   */
    protected $sucursal;

    /** @ORM\Column(type="integer") */
    protected $estado;
    
    /** @ORM\Column(type="string", length=30, nullable=true) */
    protected $cambio;
	    
	
    /** @ORM\Column(type="datetime", nullable=true) */
    protected $hora;
	
    /** @ORM\Column(type="datetime", nullable=true) */
    protected $fecha;
    
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
   * @var ArrayCollection $ordenes
   *
   * @ORM\OneToMany(targetEntity="ComandaOrden", mappedBy="comanda")
   */
    protected $ordenes;     


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
     * Set unidades
     *
     * @param integer $unidades
     * @return Comanda
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    
        return $this;
    }

    /**
     * Get unidades
     *
     * @return integer 
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Comanda
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Comanda
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
     * Set tiempo_demora
     *
     * @param string $tiempoDemora
     * @return Comanda
     */
    public function setTiempoDemora($tiempoDemora)
    {
        $this->tiempo_demora = $tiempoDemora;
    
        return $this;
    }

    /**
     * Get tiempo_demora
     *
     * @return string 
     */
    public function getTiempoDemora()
    {
        return $this->tiempo_demora;
    }

    /**
     * Set descuento
     *
     * @param float $descuento
     * @return Comanda
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return float 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Comanda
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
     * Set repartidor
     *
     * @param string $repartidor
     * @return Comanda
     */
    public function setRepartidor($repartidor)
    {
        $this->repartidor = $repartidor;
    
        return $this;
    }

    /**
     * Get repartidor
     *
     * @return string 
     */
    public function getRepartidor()
    {
        return $this->repartidor;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Comanda
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
     * Set hora
     *
     * @param integer $hora
     * @return Comanda
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    
        return $this;
    }

    /**
     * Get hora
     *
     * @return integer 
     */
    public function getHora()
    {
        return $this->hora;
    }
	

    /**
     * Set cliente
     *
     * @param \Administracion\ModeloBundle\Entity\Cliente $cliente
     * @return Comanda
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
     * Set sucursal
     *
     * @param \Administracion\ModeloBundle\Entity\Sucursal $sucursal
     * @return Comanda
     */
    public function setSucursal(\Administracion\ModeloBundle\Entity\Sucursal $sucursal)
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

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Comanda
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
     * @return Comanda
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Comanda
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ordenes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add ordenes
     *
     * @param \Administracion\ModeloBundle\Entity\ComandaOrden $ordenes
     * @return Comanda
     */
    public function addOrdene(\Administracion\ModeloBundle\Entity\ComandaOrden $ordenes)
    {
        $this->ordenes[] = $ordenes;
    
        return $this;
    }

    /**
     * Remove ordenes
     *
     * @param \Administracion\ModeloBundle\Entity\ComandaOrden $ordenes
     */
    public function removeOrdene(\Administracion\ModeloBundle\Entity\ComandaOrden $ordenes)
    {
        $this->ordenes->removeElement($ordenes);
    }

    /**
     * Get ordenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdenes()
    {
        return $this->ordenes;
    }
    
    public function getOrdenesPadres()
    {
        $padres = array();
        foreach( $this->ordenes as $orden ) {
            if( !$orden->getOrdenPadre())
                $padres[] = $orden;
        }
        
        return $padres;
    }
    
    public function getPrecioFinal()
    {
        $total = 0;
        
        foreach($this->ordenes as $orden){
            $total += $orden->getPrecio();
        }
        return $this->descuento > 0 ? $total - ($total * $this->descuento / 100) : $total;
    }
    

    /**
     * Set cambio
     *
     * @param string $cambio
     * @return Comanda
     */
    public function setCambio($cambio)
    {
        $this->cambio = $cambio;
    
        return $this;
    }

    /**
     * Get cambio
     *
     * @return string 
     */
    public function getCambio()
    {
        return $this->cambio;
    }
    
    public function getIdOrdenesCategoria($ordenPizza, $nombreCategoria)
    {
        $ids = array();
        foreach($this->ordenes as $orden){   

            if($orden->getCategoria() == $nombreCategoria && ( ( $orden->getOrdenPadre() ? $orden->getOrdenPadre()->getId() : null )   == $ordenPizza->getId() )){
                $detalles = $orden->getComandaOrdenDetalles();
                foreach($detalles as $detalle){
                    $ids[]= $detalle->getProducto()->getid();
                }
            }
        }
        return $ids;
    }
    
    public function getCantidadesFaina($ordenPizza)
    {
        $cantidades = array();
        foreach($this->ordenes as $orden){   

            if($orden->getCategoria() == 'Fainá' && ( ( $orden->getOrdenPadre() ? $orden->getOrdenPadre()->getId() : null )   == $ordenPizza->getId() )){
                $detalles = $orden->getComandaOrdenDetalles();
                foreach($detalles as $detalle){
                    $cantidades[$detalle->getProducto()->getid()]= $detalle->getCantidad();
                }
            }
        }
        return $cantidades;        
    }

    /**
     * Set domicilio
     *
     * @param \Administracion\ModeloBundle\Entity\Domicilio $domicilio
     * @return Comanda
     */
    public function setDomicilio(\Administracion\ModeloBundle\Entity\Domicilio $domicilio = null)
    {
        $this->domicilio = $domicilio;
    
        return $this;
    }

    /**
     * Get domicilio
     *
     * @return \Administracion\ModeloBundle\Entity\Domicilio 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }
}