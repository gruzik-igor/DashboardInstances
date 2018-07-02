<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Instance;
use AppBundle\Entity\InstanceResource;
use AppBundle\Entity\License;
use AppBundle\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class InstanceEntityListener
{

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

    /**
     *
     * @param Instance      $instance
     * @param LifecycleEventArgs $args
     *
     * @ORM\PostPersist
     */
    public function createLicense(Instance $instance, LifecycleEventArgs $args)
    {
        $em = $args->getObjectManager();

        $license = new License();
        $license->setRate($instance->getLicenseRate());
        $license->setIssued($instance->getLicenseIssued());
        $license->setInstance($instance);

        $em->persist($license);
        $em->flush();

        $instance->setLicense($license);

        $em->persist($instance);
        $em->flush();
    }
}
