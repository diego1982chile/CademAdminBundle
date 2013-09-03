<?php

namespace Cadem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auditor
 *
 * @ORM\Table(name="AUDITOR")
 * @ORM\Entity
 */
class Auditor
{
    /**
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
     *
     * @var integer
     * 
     * @ORM\Column(name="AUD_ID", type="integer", nullable=true)
     */
    protected $audid;		
	
	/**
     *
     * @var integer
     * 
     * @ORM\Column(name="ROL_ID", type="integer", nullable=true)
     */
    protected $rolid;		
	
	/**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_AUDITOR", type="string", length=64, nullable=false)
     */
    private $nombre;
		
	/**
     * @var codigo
     *
     * @ORM\Column(name="CODIGO_AUDITOR", type="integer", nullable=false)
     */
    private $codigo;
		
	/**
     * @var boolean
     *
     * @ORM\Column(name="ACTIVO", type="boolean", nullable=false)
     */
    private $activo;
	
	/**
     * @var \Rol
     *
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="auditores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ROL_ID", referencedColumnName="ID_ROL")
     * })
     */
    private $rol;		  
			 
    /**
     * @ORM\OneToMany(targetEntity="Auditor", mappedBy="supervisor")
     **/
    private $auditores;
		
	/**
     * @var \Supervisor
     *
     * @ORM\ManyToOne(targetEntity="Auditor", inversedBy="auditores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="AUD_ID", referencedColumnName="ID")
     * })
     */
    private $supervisor;		  
	
	public function __construct() {
        $this->auditores = new \Doctrine\Common\Collections\ArrayCollection();
    }
		
	/**
     * Get rol
     *
     * @return \Cadem\ReporteBundle\Entity\Rol
     */
    public function getRol()
    {
        return $this->rol;
    }	
	
	/**
     * Set rol
     *
     * @param \Cadem\ReporteBundle\Entity\Rol $rol
     * @return Auditor
     */
    public function setRol(\Cadem\AdminBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;
    
        return $this;
    }
	
	/**
     * Get supervisor
     *
     * @return \Cadem\ReporteBundle\Entity\Auditor
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }
	
	/**
     * Set supervisor
     *
     * @param \Cadem\ReporteBundle\Entity\Auitor $supervisor
     * @return Auditor
     */
    public function setSupervisor(\Cadem\AdminBundle\Entity\Auditor $supervisor = null)
    {
        $this->supervisor = $supervisor;
    
        return $this;
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
     * Get audid
     *
     * @return integer 
     */
    public function getAudId()
    {
        return $this->audid;
    }
	
	/**
     * Set audid
     *
     * @param integer $audid
     * @return Auditor
     */
    public function setAudId($audid)
    {
        $this->audid = $audid;
        
        return $this;
    }		
	
	/**
     * Get rolid
     *
     * @return integer 
     */
    public function getRolId()
    {
        return $this->rolid;
    }
	
	/**
     * Set rolid
     *
     * @param integer $rolid
     * @return Auditor
     */
    public function setRolId($rolid)
    {
        $this->rolid = $rolid;
        
        return $this;
    }		
		     
	/**
     * Get codigo
     *
     * @return integer 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }			 			     		    
	
	/**
     * Set codigo
     *
     * @param integer $codigo
     * @return Auditor
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
        
        return $this;
    }		
	
	/**
     * Get nombre
     *
     * @return integer 
     */
    public function getNombre()
    {
        return $this->nombre;
    }			 			     		    
	
	/**
     * Set codigo
     *
     * @param integer $codigo
     * @return Auditor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        
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
     * Set activo
     *
     * @param integer $activo
     * @return Auditor
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
        
        return $this;
    }			
	
	public function __toString()
	{
		return $this->nombre;
	}
}