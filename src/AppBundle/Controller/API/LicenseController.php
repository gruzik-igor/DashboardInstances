<?php

namespace AppBundle\Controller\API;

use AppBundle\Entity\Instance;
use AppBundle\Entity\LicenseRequest;
use AppBundle\Entity\Resource;
use AppBundle\Form\LicenseRequestForm;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LicenseController.
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("license")
 */
class LicenseController extends BaseRestController
{

    /**
     * Return license by id.
     *
     * @Rest\View(serializerGroups={"default"})
     */
    public function getAction(Instance $instance)
    {
        return $instance->getLicense();
    }

    /**
     * Request licenses.
     *
     * @Rest\Post("/licenses/request")
     */
    public function requestAction(Request $request)
    {
        return $this->handleForm($request, LicenseRequestForm::class, new LicenseRequest());
    }
}
