<?php

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 */
class Subcategoria {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string", length=50, unique = true) */
    protected $nombre;

  /**
   * @var Categoria $categoria
   *
   * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="subcategorias")
   * @ORM\JoinColumn(nullable=false, onDelete="cascade")
   * @Assert\Type(type="Administracion\ModeloBundle\Entity\Categoria")
   */
    protected $categoria;
    
  /**
   * @var ArrayCollection $productos
   *
   * @ORM\OneToMany(targetEntity="Producto", mappedBy="subcategoria")
   */
    protected $productos;        
    
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
     * @return Subcategoria
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Subcategoria
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
     * @return Subcategoria
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
     * Set categoria
     *
     * @param \Administracion\ModeloBundle\Entity\Categoria $categoria
     * @return Subcategoria
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
     * Constructor
     */
    public function __construct()
    {
        $this->productos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add productos
     *
     * @param \Administracion\ModeloBundle\Entity\Producto $productos
     * @return Subcategoria
     */
    public function addProducto(\Administracion\ModeloBundle\Entity\Producto $productos)
    {
        $this->productos[] = $productos;
    
        return $this;
    }

    /**
     * Remove productos
     *
     * @param \Administracion\ModeloBundle\Entity\Producto $productos
     */
    public function removeProducto(\Administracion\ModeloBundle\Entity\Producto $productos)
    {
        $this->productos->removeElement($productos);
    }

    /**
     * Get productos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductos()
    {
        return $this->productos;
    }
    
    public function getProductosOrdenados()
    {
        $productos = $this->productos;
        for($i = 0; $i < count($productos)-1; $i ++){
            for($x = $i+1; $x < count($productos); $x ++){
                if($productos[$x]->getNombre() < $productos[$i]->getNombre()){
                    $temp = $productos[$x];
                    $productos[$x] = $productos[$i];
                    $productos[$i] = $temp;
                }
            }
        }
        return $productos;
    }
}