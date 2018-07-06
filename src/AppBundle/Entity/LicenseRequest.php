<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Instance;

/**
 * LicenseRequest .
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class LicenseRequest
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
     * @ORM\ManyToOne(targetEntity="Instance", inversedBy="LicenseRequest")
     * @ORM\JoinColumn(name="instance_id", referencedColumnName="id")
     */
    protected $instance;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $requestedLicenses;


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
     * Set requestedLicenses
     *
     * @param integer $requestedLicenses
     *
     * @return LicenseRequest
     */
    public function setRequestedLicenses($requestedLicenses)
    {
        $this->requestedLicenses = $requestedLicenses;

        return $this;
    }

    /**
     * Get requestedLicenses
     *
     * @return integer
     */
    public function getRequestedLicenses()
    {
        return $this->requestedLicenses;
    }

    /**
     * Set instance
     *
     * @param \AppBundle\Entity\Instance $instance
     *
     * @return LicenseRequest
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
