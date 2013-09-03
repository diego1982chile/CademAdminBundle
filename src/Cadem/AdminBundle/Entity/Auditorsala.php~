<?php

namespace Cadem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auditorsala
 *
 * @ORM\Table(name="SALAAUDITOR")
 * @ORM\Entity
 */
class Auditorsala
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
     * @ORM\Column(name="AUDITOR_ID", type="integer", nullable=true)
     */
    protected $auditorid;		
	
	/**
     *
     * @var integer
     * 
     * @ORM\Column(name="SALA_ID", type="integer", nullable=true)
     */
    protected $salaid;		
			
	/**
     * @var boolean
     *
     * @ORM\Column(name="ACTIVO", type="boolean", nullable=false)
     */
    private $activo;

	/**
     * @var \Auditor
     *
     * @ORM\ManyToOne(targetEntity="Auditor", inversedBy="auditorsala")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="AUDITOR_ID", referencedColumnName="ID")
     * })
     */
    private $auditor;

    /**
     * @var \Sala
     *
     * @ORM\ManyToOne(targetEntity="Sala", inversedBy="auditorsala")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SALA_ID", referencedColumnName="ID")
     * })
     */
    private $sala;				     
	
	// public function __construct() {
        // $this->auditores = new \Doctrine\Common\Collections\ArrayCollection();
    // }
		
	/**
     * Get auditor
     *
     * @return \Cadem\ReporteBundle\Entity\Auditor
     */
    public function getAuditor()
    {
        return $this->auditor;
    }	
	
	/**
     * Set auditor
     *
     * @param \Cadem\ReporteBundle\Entity\Auditor $auditor
     * @return Auditorsala
     */
    public function setAuditor(\Cadem\AdminBundle\Entity\Auditor $auditor = null)
    {
        $this->auditor = $auditor;
    
        return $this;
    }
	
	/**
     * Get sala
     *
     * @return \Cadem\ReporteBundle\Entity\Sala
     */
    public function getSala()
    {
        return $this->sala;
    }
	
	/**
     * Set sala
     *
     * @param \Cadem\ReporteBundle\Entity\Sala $sala
     * @return Auditorsala
     */
    public function setSala(\Cadem\AdminBundle\Entity\Sala $sala = null)
    {
        $this->sala = $sala;
    
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
     * Set activo
     *
     * @param integer $activo
     * @return Auditorsala
     */
    public function setId($id)
    {
        $this->id = $id;
        
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
     * @return Auditorsala
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
        
        return $this;
    }			
	
	// public function __toString()
	// {
		// return $this->nombre;
	// }
}