<?php

namespace AppBundle\Controller\API;

use AppBundle\Entity\License;
use AppBundle\Entity\Resource;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * Class LicenseController.
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("license")
 */
class LicenseController extends FOSRestController
{

    /**
     * Return license by id.
     *
     * @Rest\View(serializerGroups={"default"})
     */
    public function getAction(License $license)
    {
        return $license;
    }
}
