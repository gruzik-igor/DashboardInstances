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
     * @Assert\NotBlank()
     */
    protected $requestedLicenses;

    /**
     * @return mixed
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * @param mixed $instance
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
    }


}
