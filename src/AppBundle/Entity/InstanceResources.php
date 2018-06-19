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
class InstanceResources 
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
     * @ORM\Column(type="ManyToOne", length=255, nullable=false)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    protected $instance;

    /**
     * @ORM\Column(type="ManyToOne",  length=255, nullable=true)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    protected $resource;

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
     * Set Instance.
     *
     * @param ManyToOne $instance
     *
     * @return InstanceResources
     */
    
     public function setInstance($instance)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * Get Instance.
     *
     * @return ManyToOne
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Set Resource.
     *
     * @param ManyToOne $resource
     *
     * @return InstanceResources
     */
    
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get Resource
     *
     * @return ManyToOne
     */
    public function geResource()
    {
        return $this->resource;
    }

}
