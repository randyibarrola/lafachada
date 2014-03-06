<?php

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="comanda_orden_detalle")
 */
class ComandaOrdenDetalle
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    
  /**
   * @var ComandaOrden $comanda_orden
   *
   * @ORM\ManyToOne(targetEntity="ComandaOrden", inversedBy="comanda_orden_detalles")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\ComandaDetalle")
   */
    protected $comanda_orden; 
    
  /**
   * @var Producto $producto
   *
   * @ORM\ManyToOne(targetEntity="Producto")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Producto")
   */
    protected $producto;     

    
    /** @ORM\Column(type="integer", nullable = true) */
    protected $cantidad;
    
    /** @ORM\Column(type="integer", nullable = true) */
    protected $numero_porcion_pizza; 


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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return ComandaOrdenDetalle
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set numero_porcion_pizza
     *
     * @param integer $numeroPorcionPizza
     * @return ComandaOrdenDetalle
     */
    public function setNumeroPorcionPizza($numeroPorcionPizza)
    {
        $this->numero_porcion_pizza = $numeroPorcionPizza;
    
        return $this;
    }

    /**
     * Get numero_porcion_pizza
     *
     * @return integer 
     */
    public function getNumeroPorcionPizza()
    {
        return $this->numero_porcion_pizza;
    }

    /**
     * Set comanda_orden
     *
     * @param \Administracion\ModeloBundle\Entity\ComandaOrden $comandaOrden
     * @return ComandaOrdenDetalle
     */
    public function setComandaOrden(\Administracion\ModeloBundle\Entity\ComandaOrden $comandaOrden)
    {
        $this->comanda_orden = $comandaOrden;
    
        return $this;
    }

    /**
     * Get comanda_orden
     *
     * @return \Administracion\ModeloBundle\Entity\ComandaOrden 
     */
    public function getComandaOrden()
    {
        return $this->comanda_orden;
    }

    /**
     * Set producto
     *
     * @param \Administracion\ModeloBundle\Entity\Producto $producto
     * @return ComandaOrdenDetalle
     */
    public function setProducto(\Administracion\ModeloBundle\Entity\Producto $producto)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \Administracion\ModeloBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
    
    public function getPrecioPizza($tipo_pizza, $porciento)            
    {
        $unidades = $this->getComandaOrden()->getUnidades() > 1 && $this->getComandaOrden()->getCategoria() != "Fainá" ? $this->getComandaOrden()->getUnidades() : 1;        
        $precio =  $tipo_pizza == 1 ? $this->getProducto()->getPrecioPizzaGrande() * $unidades : $this->getProducto()->getPrecioPizzaChica() * $unidades;
        return $precio * $porciento / 100;
    }
}