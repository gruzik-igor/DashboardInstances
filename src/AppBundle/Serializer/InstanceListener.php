<?php

namespace AppBundle\Serializer;


use AppBundle\Entity\Instance;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

class InstanceListener implements EventSubscriberInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    static public function getSubscribedEvents()
    {
        return array(
            array('event' => 'serializer.post_serialize', 'class' => 'AppBundle\Entity\Instance', 'method' => 'onPostSerialize'),
        );
    }

    public function onPostSerialize(ObjectEvent $event)
    {
        /**
         * @var Instance $obj
         */
        $obj = $event->getObject();

        if (null === $obj) {
            return;
        }

        $visitor = $event->getVisitor();

        $visitor->setData('usageLicenseCount', $this->getUsageLicenseCount($obj));
    }

    public function getUsageLicenseCount(Instance $instance)
    {
        $apiUrl = 'api/businessesCount.json';

        $result = json_decode(file_get_contents($apiUrl), true)['businessesCount'];

        return $result;
    }

}