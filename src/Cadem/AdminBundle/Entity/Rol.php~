<?php

namespace Cadem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="ROL")
 * @ORM\Entity
 */
class Rol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ROL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ROL", type="string", length=64, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ACTIVO", type="boolean", nullable=false)
     */
    private $activo;
	
	/**
     * @ORM\OneToMany(targetEntity="Auditor", mappedBy="rol")
     */
	 
	protected $auditores;
	
	public function __construct()
    {
        $this->auditores = new ArrayCollection();        
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
     * @return Rol
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
     * Set activo
     *
     * @param boolean $activo
     * @return Rol
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }
	
	/**
     * Add usuarios
     *
     * @param \Cadem\adminBundle\Entity\Usuario $usuarios
     * @return Cliente
     */
    public function addUsuario(\Cadem\adminBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;
    
        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \Cadem\adminBundle\Entity\Usuario $usuarios
     */
    public function removeUsuario(\Cadem\adminBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get auditores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuditores()
    {
        return $this->auditores;
    }
	
	public function __toString()
	{
		return $this->nombre;
	}
}