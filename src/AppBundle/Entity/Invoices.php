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
class Invoice 
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
     * @ORM\Column(type="float", length=255, nullable=false)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    protected $price;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $creationDate;

    /**
     * @ORM\Column(type="enum", length=255, nullable=false)
     * @Assert\Status()
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
     * Set Price.
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
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set Status.
     *
     * @param enum $status
     *
     * @return Invoice
     */
    
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Returns the status granted to the invoice.
     *
     * <code>
     * public function getStatus()
     * {
     *     return array('IN_PROCESS');
     * }
     * </code>
     *
     *
     * @return (Status|enum)[] The invoice status
     */
    public function getStatus()
    {
        return array($this->status ? $this->status : 'IN_PROCESS');
    }

    /**
     * Set CreationDate
     *
     * @ORM\PrePersist()
     *
     * @return Invoice
     */
    public function setCreationDate($creationDate = null)
    {
        $this->creationDate = new \DateTime('now');

        return $this;
    }

    /**
     * Get CreationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }


    /**
     * Set expirationDate
     *
     * @param datetime $expirationDate
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
     * @return datetime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

}
