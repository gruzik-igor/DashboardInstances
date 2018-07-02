<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Instance;
use AppBundle\Entity\InstanceResource;
use AppBundle\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class InstanceEntityListener
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     *
     * @param Instance      $instance
     * @param LifecycleEventArgs $args
     *
     * @ORM\PostPersist
     */
    public function createResources(Instance $instance, LifecycleEventArgs $args)
    {
        $em = $args->getObjectManager();

        $repository = $em->getRepository('AppBundle:Resource');

        $resources = $repository->findAll();
        /**
         * @var Resource $resource
         */
        foreach ($resources as $resource) {
            $instanceResource = new InstanceResource();

            $instanceResource->setInstance($instance);
            $instanceResource->setResource($resource);
            $instanceResource->setValue($resource->getDefaultValue());

            $em->persist($instanceResource);
        }

        $em->flush();
    }
}
