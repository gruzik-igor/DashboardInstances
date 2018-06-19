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
     * @ORM\OneToMany(targetEntity="License", mappedBy="instance")
     */
    protected $licenses;

    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="instance")
     */
    protected $invoices;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    protected $status;  
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
     * Add license
     *
     * @param \AppBundle\Entity\License $license
     *
     * @return Instance
     */
    public function addLicense(\AppBundle\Entity\License $license)
    {
        $this->licenses[] = $license;

        return $this;
    }

    /**
     * Remove license
     *
     * @param \AppBundle\Entity\License $license
     */
    public function removeLicense(\AppBundle\Entity\License $license)
    {
        $this->licenses->removeElement($license);
    }

    /**
     * Get licenses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLicenses()
    {
        return $this->licenses;
    }

    /**
     * Add invoice
     *
     * @param \AppBundle\Entity\Invoice $invoice
     *
     * @return Instance
     */
    public function addInvoice(\AppBundle\Entity\Invoice $invoice)
    {
        $this->invoices[] = $invoice;

        return $this;
    }

    /**
     * Remove invoice
     *
     * @param \AppBundle\Entity\Invoice $invoice
     */
    public function removeInvoice(\AppBundle\Entity\Invoice $invoice)
    {
        $this->invoices->removeElement($invoice);
    }

    /**
     * Get invoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoices()
    {
        return $this->invoices;
    }
}
