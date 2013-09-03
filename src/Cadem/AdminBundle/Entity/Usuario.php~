<?php

namespace Cadem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * Usuario
 *
 * @ORM\Table(name="USUARIO")
 * @ORM\Entity
 */
class Usuario extends BaseUser
{
    /**
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="RUT", type="string", length=64, nullable=true)
     */
    private $rut;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CLIENTE_ID", referencedColumnName="ID")
     * })
     */
    private $cliente;
	
	/**
     * @var \Rol
     *
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ROL_ID", referencedColumnName="ID")
     * })
     */
    private $rol;

    /**
     *
     * @ORM\Column(name="CLIENTE_ID", type="integer", nullable=true)
     */
    private $clienteid;

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
     * Get rut
     *
     * @return string
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set rut
     *
     * @param string $rut
     * @return Usuario
     */
    public function setRut($rut)
    {
        $this->rut = $rut;
    
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime", length=6, nullable=true)
     */
    private $createdAt;
	
	/**
     * @var string
     *
     * @ORM\Column(name="updated_at", type="datetime", length=6, nullable=true)
     */
    private $updatedAt;	

    /**
     * Set cliente
     *
     * @param \Cadem\adminBundle\Entity\Cliente $cliente
     * @return Usuario
     */
    public function setCliente(\Cadem\adminBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Cadem\adminBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }
	
	/**
     * Get rol
     *
     * @return \Cadem\adminBundle\Entity\Rol 
     */
    public function getRol()
    {
        return $this->rol;
    }
	
	 public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get clienteid
     *
     * @return integer 
     */
    public function getClienteId()
    {
        return $this->clienteid;
    }

    /**
     * Set clienteid
     *
     * @param integer $clienteid
     * @return Usuario
     */
    public function SetClienteId($clienteid)
    {
        $this->clienteid = $clienteid;
        
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
     * @return Usuario
     */
    public function setRolId($rolid)
    {
        $this->rolid = $rolid;
        
        return $this;
    }		
	
	/**
     * Get createdAt
     *
     * @return string 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param string $createdAt
     * @return Usuario
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }
	
	/**
     * Get updatedAt
     *
     * @return string 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param string $updatedAt
     * @return Usuario
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }
}