<?php

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="comanda_orden")
 */
class ComandaOrden 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
  /**
   * @var Comanda $comanda
   *
   * @ORM\ManyToOne(targetEntity="Comanda", inversedBy="ordenes")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Comanda")
   */
    protected $comanda;  
    
  /**
   * @var ComandaOrden $orden_padre
   *
   * @ORM\ManyToOne(targetEntity="ComandaOrden", inversedBy="ordenes_hijas")
   * @ORM\JoinColumn(nullable=true, onDelete="cascade", name="orden_padre_id", referencedColumnName="id")
   */
    protected $orden_padre;  
    
  /**
   * @var ArrayCollection $ordenes_hijas
   *
   * @ORM\OneToMany(targetEntity="ComandaOrden", mappedBy="orden_padre")
   */
    protected $ordenes_hijas;         
    
  /**
   * @var Categoria $categoria
   *
   * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="$comanda_orden_detalles")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Categoria")
   */
    protected $categoria; 
    
  /**
   * @var ArrayCollection $comanda_orden_detalles
   *
   * @ORM\OneToMany(targetEntity="ComandaOrdenDetalle", mappedBy="comanda_orden")
   */
    protected $comanda_orden_detalles;        
    
    /** @ORM\Column(type="integer", nullable = true) */
    protected $tipo_pizza;
    
    /** @ORM\Column(type="integer", nullable = true) */
    protected $cantidad_porciones; 
    
    /** @ORM\Column(type="text", nullable = true) */
    protected $comentario;   
    
    
    /** @ORM\Column(type="integer", nullable=true) */
    protected $unidades;    
  
    
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comanda_orden_detalles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tipo_pizza
     *
     * @param integer $tipoPizza
     * @return ComandaOrden
     */
    public function setTipoPizza($tipoPizza)
    {
        $this->tipo_pizza = $tipoPizza;
    
        return $this;
    }

    /**
     * Get tipo_pizza
     *
     * @return integer 
     */
    public function getTipoPizza()
    {
        return $this->tipo_pizza;
    }

    /**
     * Set cantidad_porciones
     *
     * @param integer $cantidadPorciones
     * @return ComandaOrden
     */
    public function setCantidadPorciones($cantidadPorciones)
    {
        $this->cantidad_porciones = $cantidadPorciones;
    
        return $this;
    }

    /**
     * Get cantidad_porciones
     *
     * @return integer 
     */
    public function getCantidadPorciones()
    {
        return $this->cantidad_porciones;
    }

    /**
     * Set comanda
     *
     * @param \Administracion\ModeloBundle\Entity\Comanda $comanda
     * @return ComandaOrden
     */
    public function setComanda(\Administracion\ModeloBundle\Entity\Comanda $comanda)
    {
        $this->comanda = $comanda;
    
        return $this;
    }

    /**
     * Get comanda
     *
     * @return \Administracion\ModeloBundle\Entity\Comanda 
     */
    public function getComanda()
    {
        return $this->comanda;
    }

    /**
     * Set categoria
     *
     * @param \Administracion\ModeloBundle\Entity\Categoria $categoria
     * @return ComandaOrden
     */
    public function setCategoria(\Administracion\ModeloBundle\Entity\Categoria $categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Administracion\ModeloBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add comanda_orden_detalles
     *
     * @param \Administracion\ModeloBundle\Entity\ComandaOrdenDetalle $comandaOrdenDetalles
     * @return ComandaOrden
     */
    public function addComandaOrdenDetalle(\Administracion\ModeloBundle\Entity\ComandaOrdenDetalle $comandaOrdenDetalles)
    {
        $this->comanda_orden_detalles[] = $comandaOrdenDetalles;
    
        return $this;
    }

    /**
     * Remove comanda_orden_detalles
     *
     * @param \Administracion\ModeloBundle\Entity\ComandaOrdenDetalle $comandaOrdenDetalles
     */
    public function removeComandaOrdenDetalle(\Administracion\ModeloBundle\Entity\ComandaOrdenDetalle $comandaOrdenDetalles)
    {
        $this->comanda_orden_detalles->removeElement($comandaOrdenDetalles);
    }

    /**
     * Get comanda_orden_detalles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComandaOrdenDetalles()
    {
        return $this->comanda_orden_detalles;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return ComandaOrden
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
     
    public function getPrecio()
    {  
        $total = 0;
        $cantidadEmpanadasGratis = 0;
        $totalEmpanadas = 0;
        $categoriaPizza = $this->categoria == 'Pizzas';       
        
        
        foreach ($this->comanda_orden_detalles as $detalle) {
            if($categoriaPizza){
                $precio = $this->tipo_pizza === 1 ? $detalle->getProducto()->getPrecioGrande() : $detalle->getProducto()->getPrecioChica();
                $total += $this->cantidad_porciones === 1 ?( $this->getUnidadesOrdenPadre() > 1 ? $precio * $this->getUnidadesOrdenPadre() : $precio ) : $precio * $this->getPorcientoPizza($detalle->getNumeroPorcionPizza()) / 100;
                             
            }
            else{
                if($this->categoria == 'Empanadas'){
                    $totalEmpanadas += $detalle->getCantidad();
                    $division = intval($totalEmpanadas / 12);
                    if( $division > $cantidadEmpanadasGratis  ){                       
                        $total += $detalle->getProducto()->getPrecio() * ( $detalle->getCantidad() - ($division - $cantidadEmpanadasGratis) );
                        $cantidadEmpanadasGratis = $division - $cantidadEmpanadasGratis;
                    } else {
                        $total += $detalle->getProducto()->getPrecio() * ( $detalle->getCantidad() - ($division - $cantidadEmpanadasGratis) );
                    }
                } else {                    
                    $unidades = $this->getUnidadesOrdenPadre();
                    $total += ($detalle->getProducto()->getPrecio() * $detalle->getCantidad()) * $unidades;
                }
                
            }
        }  
        return $total;
    } 
    
    public function getPorcientoPizza($porcion){
        switch ($this->cantidad_porciones){
            case 1:
                return 100;
            case 2:
                return 50;
            case 3:
                return $porcion === 1 ? 50 : 25;
            case 4:
                return 25;                
        }    
    }

    /**
     * Set orden_padre
     *
     * @param \Administracion\ModeloBundle\Entity\ComandaOrden $ordenPadre
     * @return ComandaOrden
     */
    public function setOrdenPadre(\Administracion\ModeloBundle\Entity\ComandaOrden $ordenPadre = null)
    {
        $this->orden_padre = $ordenPadre;
    
        return $this;
    }

    /**
     * Get orden_padre
     *
     * @return \Administracion\ModeloBundle\Entity\ComandaOrden 
     */
    public function getOrdenPadre()
    {
        return $this->orden_padre;
    }

    /**
     * Add ordenes_hijas
     *
     * @param \Administracion\ModeloBundle\Entity\ComandaOrden $ordenesHijas
     * @return ComandaOrden
     */
    public function addOrdenesHija(\Administracion\ModeloBundle\Entity\ComandaOrden $ordenesHijas)
    {
        $this->ordenes_hijas[] = $ordenesHijas;
    
        return $this;
    }

    /**
     * Remove ordenes_hijas
     *
     * @param \Administracion\ModeloBundle\Entity\ComandaOrden $ordenesHijas
     */
    public function removeOrdenesHija(\Administracion\ModeloBundle\Entity\ComandaOrden $ordenesHijas)
    {
        $this->ordenes_hijas->removeElement($ordenesHijas);
    }

    /**
     * Get ordenes_hijas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdenesHijas()
    {
        return $this->ordenes_hijas;
    }
    
    public function getValorProductoEnDetalle($productoId)
    {
        foreach($this->comanda_orden_detalles  as $detalle){
            if($detalle->getProducto()->getId() == $productoId) {
                return $detalle->getCantidad();
            }
        }
        
        return 0;
    }

    /**
     * Set unidades
     *
     * @param integer $unidades
     * @return ComandaOrden
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
    
    public function getUnidadesRedondeadas()
    {
        return $this->unidades ? $this->unidades : 1;
    }    
    
    public function getUnidadesOrdenPadre()
    {
        if($this->getCategoria() == 'Pizzas'){
            return  $this->unidades > 1 ? $this->unidades : 1;           
        } else {
            
            if($this->orden_padre){
                if($this->orden_padre->getUnidades() > 1 && $this->getCategoria() != "Fainá")
                    return $this->orden_padre->getUnidades();

                return 1;
            } 
        }
            
       return 1;
        
    }
    
    public function getDetalleSegunPorcion($porcion)
    {
        foreach($this->comanda_orden_detalles as $detalle) {
            if($detalle->getNumeroPorcionPizza() == $porcion) 
                return $detalle;
        }
        
        return null;
    }

}