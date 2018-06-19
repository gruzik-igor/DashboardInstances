<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Invoices.
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\EntityListeners({"AppBundle\EventListener\UserEntityListener"})
 */
class Instance 
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @ORM\Column(type="OneToMany",  length=255, nullable=true)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    protected $resources;

    /**
     * @ORM\Column(type="OneToMany", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    protected $licenses;

    /**
     * @ORM\Column(type="OneToMany", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    protected $latestInvoices;

    /**
     * @ORM\Column(type="enum", length=255, nullable=false)
     * @Assert\Status()
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    protected $status;

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
     * Set Name.
     *
     * @param string $name
     *
     * @return Instance
     */
    
     public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Resources.
     *
     * @param OneToMany $resources
     *
     * @return Instance
     */
    
    public function setResources($resources)
    {
        $this->resources = $resources;

        return $this;
    }

    /**
     * Get Resources.
     *
     * @return OneToMany
     */
    public function getResources()
    {
        return $this->resources;
    }


    /**
     * Set Licenses.
     *
     * @param OneToMany $licenses
     *
     * @return Instance
     */
    
    public function setLicenses($licenses)
    {
        $this->licenses = $licenses;

        return $this;
    }

    /**
     * Get Licenses.
     *
     * @return OneToMany
     */
    public function getLicenses()
    {
        return $this->licenses;
    }

    /**
     * Set LatestInvoices.
     *
     * @param OneToMany $latestInvoices
     *
     * @return Instance
     */
    
    public function setLatestInvoices($latestInvoices)
    {
        $this->latestInvoices = $latestInvoices;

        return $this;
    }

    /**
     * Get LatestInvoices.
     *
     * @return OneToMany
     */
    public function getLatestInvoices()
    {
        return $this->latestInvoices;
    }
    
    
    /**
     * Set Status.
     *
     * @param enum $status
     *
     * @return Instance
     */
    
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Returns the status granted to the Instance.
     *
     * <code>
     * public function getStatus()
     * {
     *     return array('REGISTER');
     * }
     * </code>
     *
     *
     * @return (Status|enum)[] The Instance status
     */
    public function getStatus()
    {
        return array($this->status ? $this->status : 'REGISTER');
    }   
}
