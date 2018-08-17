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
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    protected $contactPerson;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\OneToMany(targetEntity="InstanceResource", mappedBy="instance")
     */
    protected $resources;

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
     * @Assert\NotBlank()
     */
    protected $licenseRate;

    /**
     * @Assert\NotBlank()
     */
    protected $licenseIssued;

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
        $this->licenses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->invoices = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set contactPerson
     *
     * @param string $name
     *
     * @return Instance
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson= $contactPerson;

        return $this;
    }

    /**
     * Get contactPerson
     *
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
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
     * @return Invoice
     */
    public function setDeployingDate($deployingDate)
    {
        $this->deployingDate = $deployingDate;

        return $this;
    }

    /**
     * Get creationDate
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

    /**
     * Set license
     *
     * @param \AppBundle\Entity\License $license
     *
     * @return Instance
     */
    public function setLicense(\AppBundle\Entity\License $license = null)
    {
        $this->license = $license;

        return $this;
    }

    /**
     * Get license
     *
     * @return \AppBundle\Entity\License
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * Set invoice
     *
     * @param \AppBundle\Entity\Invoice $invoice
     *
     * @return Instance
     */
    public function setInvoice(\AppBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \AppBundle\Entity\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setLicenseRate($licenseRate)
    {
        $this->licenseRate = $licenseRate;

        return $this;
    }

    public function getLicenseRate()
    {
        return $this->licenseRate;
    }

    public function setLicenseIssued($licenseIssued)
    {
        $this->licenseIssued = $licenseIssued;

        return $this;
    }

    public function getLicenseIssued()
    {
        return $this->licenseIssued;
    }
}
