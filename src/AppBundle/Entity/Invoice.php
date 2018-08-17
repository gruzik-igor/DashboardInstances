<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;
/**
 * Invoice.
 * @JMS\ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InvoiceRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Invoice 
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
     * @ORM\OneToOne(targetEntity="Instance", inversedBy="invoice")
     * @ORM\JoinColumn(name="instance_id", referencedColumnName="id")
     */
    protected $instance;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(type="float", length=255, nullable=false)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    protected $price;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $creationDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    protected $status;

    /**
     * @ORM\Column(type="date", length=255, nullable=true)
     * @Assert\Length(max="255")
     */
    protected $expirationDate;

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
     * Set price
     *
     * @param float $price
     *
     * @return Invoice
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Invoice
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Invoice
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
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     *
     * @return Invoice
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate
     *
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }


    /**
     * Set instance
     *
     * @param \AppBundle\Entity\Instance $instance
     *
     * @return Invoice
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
