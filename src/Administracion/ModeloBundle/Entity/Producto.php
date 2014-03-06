<?php

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 */
class Producto {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

  /**
   * @var Categoria $categoria
   *
   * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="productos")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Categoria")
   */
    protected $categoria;

  /**
   * @var Subcategoria $subcategoria
   *
   * @ORM\ManyToOne(targetEntity="Subcategoria", inversedBy="productos")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Subcategoria")
   */
    protected $subcategoria;
    
    /** @ORM\Column(type="string", length=80) */
    protected $nombre;

    /** @ORM\Column(type="text") */
    protected $descripcion;

    /** @ORM\Column(type="decimal",scale=2, nullable = true) */
    protected $precio_pizza_grande;

    /** @ORM\Column(type="decimal", scale=2, nullable = true) */
    protected $precio_pizza_chica;
    
    /** @ORM\Column(type="decimal", scale=2, nullable = true) */
    protected $precio_pizza_recargo;    

    /** @ORM\Column(type="string", nullable = true) */
    protected $recargos;

    /** @ORM\Column(type="decimal",scale=2,  nullable = true) */
    protected $precio;

   
    public function getTextoDescriptivo()
    {
        $cadena = '$';
        $descripcion = $this->descripcion;          
  
        
        if ($this->categoria->getNombre() == 'Pizzas')
        {
            $precioGrande = $this->precio_pizza_grande; 
            $precioChica = $this->precio_pizza_chica;
            
            $cadena .= $precioGrande.' / '.$precioChica.' .-/ '.$descripcion;
        }
        else
        {
            $cadena .= $this->precio.' .-/ '.$descripcion;
        }
        
        return $cadena;        
    }
    
    public function getPrecioListado()
    {
        $precio =  $this->categoria->getNombre() == 'Pizzas' ? $this->precio_pizza_grande. ' / '.$this->precio_pizza_chica : $this->precio;   
        return '$ '.$precio;
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
     * @return Producto
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set precio_grande
     *
     * @param float $precioGrande
     * @return Producto
     */
    public function setPrecioGrande($precioGrande)
    {
        $this->precio_grande = $precioGrande;
    
        return $this;
    }

    /**
     * Get precio_grande
     *
     * @return float 
     */
    public function getPrecioGrande()
    {
        return $this->precio_pizza_grande;
    }

    /**
     * Set precio_chica
     *
     * @param float $precioChica
     * @return Producto
     */
    public function setPrecioChica($precioChica)
    {
        $this->precio_chica = $precioChica;
    
        return $this;
    }

    /**
     * Get precio_chica
     *
     * @return float 
     */
    public function getPrecioChica()
    {
        return $this->precio_pizza_chica;
    }

    /**
     * Set recargos
     *
     * @param string $recargos
     * @return Producto
     */
    public function setRecargos($recargos)
    {
        $this->recargos = $recargos;
    
        return $this;
    }

    /**
     * Get recargos
     *
     * @return string 
     */
    public function getRecargos()
    {
        return $this->recargos;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Producto
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
     * Set categoria
     *
     * @param \Administracion\ModeloBundle\Entity\Categoria $categoria
     * @return Producto
     */
    public function setCategoria(\Administracion\ModeloBundle\Entity\Categoria $categoria = null)
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
     * Set subcategoria
     *
     * @param \Administracion\ModeloBundle\Entity\Subcategoria $subcategoria
     * @return Producto
     */
    public function setSubcategoria(\Administracion\ModeloBundle\Entity\Subcategoria $subcategoria = null)
    {
        $this->subcategoria = $subcategoria;
    
        return $this;
    }

    /**
     * Get subcategoria
     *
     * @return \Administracion\ModeloBundle\Entity\Subcategoria 
     */
    public function getSubcategoria()
    {
        return $this->subcategoria;
    }

    /**
     * Set precio_pizza_grande
     *
     * @param float $precioPizzaGrande
     * @return Producto
     */
    public function setPrecioPizzaGrande($precioPizzaGrande)
    {
        $this->precio_pizza_grande = $precioPizzaGrande;
    
        return $this;
    }

    /**
     * Get precio_pizza_grande
     *
     * @return float 
     */
    public function getPrecioPizzaGrande()
    {
        return $this->precio_pizza_grande;
    }

    /**
     * Set precio_pizza_chica
     *
     * @param float $precioPizzaChica
     * @return Producto
     */
    public function setPrecioPizzaChica($precioPizzaChica)
    {
        $this->precio_pizza_chica = $precioPizzaChica;
    
        return $this;
    }

    /**
     * Get precio_pizza_chica
     *
     * @return float 
     */
    public function getPrecioPizzaChica()
    {
        return $this->precio_pizza_chica;
    }

    /**
     * Set precio_pizza_recargo
     *
     * @param float $precioPizzaRecargo
     * @return Producto
     */
    public function setPrecioPizzaRecargo($precioPizzaRecargo)
    {
        $this->precio_pizza_recargo = $precioPizzaRecargo;
    
        return $this;
    }

    /**
     * Get precio_pizza_recargo
     *
     * @return float 
     */
    public function getPrecioPizzaRecargo()
    {
        return $this->precio_pizza_recargo;
    }
}