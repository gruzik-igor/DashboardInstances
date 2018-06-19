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
class License 
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
     * @ORM\Column(type="integer",  length=255, nullable=true)
     */
    protected $issued;

    /**
     * @ORM\Column(type="integer", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    protected $usage;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     * @Assert\Length(max="255")
     */
    protected $rate;

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
     * @return License
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
     * Set Issued.
     *
     * @param integer $issued
     *
     * @return License
     */
    
    public function setIssued($issued)
    {
        $this->issued = $issued;

        return $this;
    }

    /**
     * Get Issued
     *
     * @return integer
     */
    public function getIssued()
    {
        return $this->issued;
    }


    /**
     * Set Usage.
     *
     * @param integer $usage
     *
     * @return License
     */
    
    public function setUsage($usage)
    {
        $this->usage = $usage;

        return $this;
    }

    /**
     * Get Usage
     *
     * @return integer
     */
    public function getUsage()
    {
        return $this->usage;
    }

    /**
     * Set Rate.
     *
     * @param integer $rate
     *
     * @return License
     */
    
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get Rate.
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }


}
