<?php

namespace Administracion\ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 */
class Categoria {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string", length=50, unique = true) */
    protected $nombre;
    
  /**
   * @var ArrayCollection $subcategorias
   *
   * @ORM\OneToMany(targetEntity="Subcategoria", mappedBy="categoria")
   */
    protected $subcategorias;  
    
  /**
   * @var ArrayCollection $productos
   *
   * @ORM\OneToMany(targetEntity="Producto", mappedBy="categoria")
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
     * @return Categoria
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
     * @return Categoria
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
     * @return Categoria
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
        $this->subcategorias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add subcategorias
     *
     * @param \Administracion\ModeloBundle\Entity\Subcategoria $subcategorias
     * @return Categoria
     */
    public function addSubcategoria(\Administracion\ModeloBundle\Entity\Subcategoria $subcategorias)
    {
        $this->subcategorias[] = $subcategorias;
    
        return $this;
    }

    /**
     * Remove subcategorias
     *
     * @param \Administracion\ModeloBundle\Entity\Subcategoria $subcategorias
     */
    public function removeSubcategoria(\Administracion\ModeloBundle\Entity\Subcategoria $subcategorias)
    {
        $this->subcategorias->removeElement($subcategorias);
    }

    /**
     * Get subcategorias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubcategorias()
    {
        return $this->subcategorias;
    }

    /**
     * Add productos
     *
     * @param \Administracion\ModeloBundle\Entity\Producto $productos
     * @return Categoria
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
    
    public function getSubcategoriasArray()
    {
        $resultado = array();
        foreach($this->subcategorias as $subcategoria){
            $resultado[$subcategoria->getid()] = $subcategoria->getNombre();
        }
        return $resultado;
    }
}