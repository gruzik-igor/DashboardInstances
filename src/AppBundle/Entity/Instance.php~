<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Instance.
 * @JMS\ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstanceRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\EntityListeners({"AppBundle\EventListener\InstanceEntityListener"})
 */
class Instance 
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
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    protected $userMA;

    /**
     * @ORM\OneToMany(targetEntity="InstanceResource", mappedBy="instance")
     */
    protected $resources;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $licenseIssued;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $licenseRate;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Length(max="255")
     */
    protected $status = 'active';

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Length(max="255")
     */
    protected $deployingStatus = 'pending';

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $deployingDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    protected $domain = 'localhost:8000';
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resources = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get userMA
     *
     * @return string
     */
    public function getUserMA()
    {
        return $this->userMA;
    }

    /**
     * Set userMA
     *
     * @param string $userMA
     *
     * @return Instance
     */
    public function setUserMA($userMA)
    {
        $this->userMA = $userMA;
        return $this;
    }
    /**
     * Set licenseIssued
     *
     * @param integer $licenseIssued
     *
     * @return Instance
     */
    public function setLicenseIssued($licenseIssued)
    {
        $this->licenseIssued = $licenseIssued;

        return $this;
    }

    /**
     * Get licenseIssued
     *
     * @return integer
     */
    public function getLicenseIssued()
    {
        return $this->licenseIssued;
    }

    /**
     * Set licenseRate
     *
     * @param integer $licenseRate
     *
     * @return Instance
     */
    public function setLicenseRate($licenseRate)
    {
        $this->licenseRate = $licenseRate;

        return $this;
    }

    /**
     * Get licenseRate
     *
     * @return integer
     */
    public function getLicenseRate()
    {
        return $this->licenseRate;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Instance
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set deployingStatus
     *
     * @param string $deployingStatus
     *
     * @return Instance
     */
    public function setDeployingStatus($deployingStatus)
    {
        $this->deployingStatus = $deployingStatus;

        return $this;
    }

    /**
     * Get deployingStatus
     *
     * @return string
     */
    public function getDeployingStatus()
    {
        return $this->deployingStatus;
    }

    /**
     * Set deployingDate
     *
     * @param \DateTime $deployingDate
     *
     * @return Instance
     */
    public function setDeployingDate($deployingDate)
    {
        $this->deployingDate = $deployingDate;

        return $this;
    }

    /**
     * Get deployingDate
     *
     * @return \DateTime
     */
    public function getDeployingDate()
    {
        return $this->deployingDate;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return Instance
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Add resource
     *
     * @param \AppBundle\Entity\InstanceResource $resource
     *
     * @return Instance
     */
    public function addResource(\AppBundle\Entity\InstanceResource $resource)
    {
        $this->resources[] = $resource;

        return $this;
    }

    /**
     * Remove resource
     *
     * @param \AppBundle\Entity\InstanceResource $resource
     */
    public function removeResource(\AppBundle\Entity\InstanceResource $resource)
    {
        $this->resources->removeElement($resource);
    }

    /**
     * Get resources
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResources()
    {
        return $this->resources;
    }
}
