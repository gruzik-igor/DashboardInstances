<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;
/**
 * Invoices.
 * @JMS\ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LicenseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class License 
{
    /**
     * @var int
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\OneToOne(targetEntity="Instance", inversedBy="licence")
     * @ORM\JoinColumn(name="instance_id", referencedColumnName="id")
     */
    protected $instance;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(type="integer",  length=255, nullable=true)
     */
    protected $issued;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
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
     * Set used
     *
     * @param integer $used
     *
     * @return License
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return integer
     */
    public function getUsed()
    {
        return $this->used;
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
     * Set requestDate
     *
     * @param \DateTime $requestDate
     *
     * @return Invoice
     */
    public function setRequestDate($requestDate)
    {
        $this->creationDate = $requestDate;

        return $this;
    }

    /**
     * Get requestDate
     *
     * @return \DateTime
     */
    public function getRequestDate()
    {
        return $this->requestDate;
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
