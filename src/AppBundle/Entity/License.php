<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Invoices.
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\OneToOne(targetEntity="Instance", mappedBy="license")
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
     * Set issued
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
     * Get issued
     *
     * @return integer
     */
    public function getIssued()
    {
        return $this->issued;
    }

    /**
     * Set usage
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
     * Get usage
     *
     * @return integer
     */
    public function getUsage()
    {
        return $this->usage;
    }

    /**
     * Set rate
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
     * Get rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set instance
     *
     * @param \AppBundle\Entity\Instance $instance
     *
     * @return License
     */
    public function setInstance(\AppBundle\Entity\Instance $instance = null)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * Get instance
     *
     * @return \AppBundle\Entity\Instance
     */
    public function getInstance()
    {
        return $this->instance;
    }
}
