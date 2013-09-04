<?php

namespace Cadem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estudiosala
 *
 * @ORM\Table(name="SALAESTUDIO")
 * @ORM\Entity(repositoryClass="Cadem\AdminBundle\Repository\EstudiosalaRepository")
 */
class Estudiosala
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
     * @ORM\Column(name="ESTUDIO_ID", type="integer", nullable=true)
     */
    protected $estudioid;		
	
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
     * @var \Estudio
     *
     * @ORM\ManyToOne(targetEntity="Estudio", inversedBy="estudiosala")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ESTUDIO_ID", referencedColumnName="ID")
     * })
     */
    private $estudio;

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
     * Get estudio
     *
     * @return \Cadem\ReporteBundle\Entity\Estudio
     */
    public function getEstudio()
    {
        return $this->estudio;
    }	
	
	/**
     * Set estudio
     *
     * @param \Cadem\ReporteBundle\Entity\Estudio $estudio
     * @return Estudiosala
     */
    public function setEstudio(\Cadem\AdminBundle\Entity\Estudio $estudio = null)
    {
        $this->estudio = $estudio;
    
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
     * @return Estudiosala
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
     * @return Estudiosala
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
     * @return Estudiosala
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