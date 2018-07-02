<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Instance.
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\OneToMany(targetEntity="InstanceResource", mappedBy="instance")
     */
    protected $resources;

    /**
     * @ORM\OneToOne(targetEntity="License", inversedBy="instance")
     * @ORM\JoinColumn(name="license_id", referencedColumnName="id")
     */
    protected $license;

    /**
     * @ORM\OneToOne(targetEntity="Invoice", inversedBy="instance")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     */
    protected $invoice;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    protected $status = 'pending';
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resources = new \Doctrine\Common\Collections\ArrayCollection();
        $this->licenses = new \Doctrine\Common\Collections\ArrayCollection();
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
}
