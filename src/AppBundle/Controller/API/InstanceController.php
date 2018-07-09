<?php

namespace AppBundle\Controller\API;

use AppBundle\Entity\Instance;
use AppBundle\Entity\Invoice;
use AppBundle\Entity\Resource;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;

/**
 * Class InstanceController.
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("instance")
 */
class InstanceController extends BaseRestController
{
    /**
     * Return section.
     *
     * @Rest\QueryParam(name="_sort")
     * @Rest\QueryParam(name="_limit",  requirements="\d+", nullable=true, strict=true)
     * @Rest\QueryParam(name="_offset", requirements="\d+", nullable=true, strict=true)
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        /** @var EntityRepository $repository */
        $repository = $this->getRepository('AppBundle:Instance');
        $paramFetcher = $paramFetcher->all();

        return $this->matching($repository, $paramFetcher, null, ['default']);
    }
}
