<?php

namespace AppBundle\Command;

use AppBundle\Entity\Instance;
use AppBundle\Repository\InstanceRepository;
use Cronfig\Sysinfo\AbstractOs;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class StatusDeployingCommand extends ContainerAwareCommand

{
    protected function configure()
    {
        $this->setName('app:change:status')
            ->addArgument('instance', InputArgument::REQUIRED, 'Instance id')
            ->setDescription('An EndlessCommand implementation example');
    }

    // Execute will be called in a endless loop
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->deployingAction($input->getArgument('instance'));

    }


    protected function deployingAction($instanceId)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $repository = $em->getRepository('AppBundle:Instance');

        $instance = $repository->findOneById($instanceId);

        if ($instance instanceof Instance) {
            $instance->setDeployingStatus('deployed');

            $instance->setDeployingDate(new \DateTime());

            $em->persist($instance);
            $em->flush();

            print_r("Success! \n");
        }

        print_r("Failed! \n".'Instance: '.$instanceId."\n");

    }


}