<?php

namespace AppBundle\Command;

use Cronfig\Sysinfo\AbstractOs;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class ReportsChartsCommand extends ContainerAwareCommand

{
    protected function configure()
    {
        $this->setName('app:report:info')
            ->setDescription('An EndlessCommand implementation example');
    }
    // Execute will be called in a endless loop
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->issuedLicense();
        $this->priceInvoice();
        $this->activeInstance();
        $this->suspendedInstance();


    }

    // Issued License Count
    protected function issuedLicense()
    {

        $filePath = $this->getContainer()->get('kernel')->getRootDir() . '/../web/charts';

        $today = new \DateTime();

        $today = $today->format('d-m-Y');

         $em = $this->getContainer()->get('doctrine.orm.entity_manager');
         $iss = $em->getRepository('AppBundle:License')->getIssuedLicenseCount();


        $issued = ['c' => [['v' => $today, 'f' => null], ['v' => $iss , 'f' => null]]];

        $inp = file_get_contents($filePath.'/issuedLicense.json');
        $tempArray = json_decode($inp, true);
        $count =  count($tempArray['rows']);

        if ($count >= 10)
        {
            array_shift($tempArray['rows']);

        }

        $tempArray['rows'][] = $issued;

        file_put_contents($filePath.'/issuedLicense.json', json_encode($tempArray));

    }

    // Price Invoice Count
    protected function priceInvoice()
    {

        $filePath = $this->getContainer()->get('kernel')->getRootDir() . '/../web/charts';

        $today = new \DateTime();

        $today = $today->format('d-m-Y');

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $price = $em->getRepository('AppBundle:Invoice')->getPriceInvoiceCount();


        $price = ['c' => [['v' => $today, 'f' => null], ['v' => $price , 'f' => null]]];

        $inp = file_get_contents($filePath.'/priceInvoice.json');
        $tempArray = json_decode($inp, true);
        $count =  count($tempArray['rows']);

        if ($count >= 15)
        {
            array_shift($tempArray['rows']);

        }

        $tempArray['rows'][] = $price;

        file_put_contents($filePath.'/priceInvoice.json', json_encode($tempArray));

    }

    // Active Instance Count
    protected function activeInstance()
    {

        $filePath = $this->getContainer()->get('kernel')->getRootDir() . '/../web/charts';

        $today = new \DateTime();

        $today = $today->format('d-m-Y');

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $active = $em->getRepository('AppBundle:Instance')->getActiveInstanceCount();


        $active = ['c' => [['v' => $today, 'f' => null], ['v' => $active , 'f' => null]]];

        $inp = file_get_contents($filePath.'/activeInstance.json');
        $tempArray = json_decode($inp, true);
        $count =  count($tempArray['rows']);

        if ($count >= 15)
        {
            array_shift($tempArray['rows']);

        }
        $tempArray['rows'][] = $active;

        file_put_contents($filePath.'/activeInstance.json', json_encode($tempArray));

    }

    // Suspended Instance Count
    protected function suspendedInstance()
    {

        $filePath = $this->getContainer()->get('kernel')->getRootDir() . '/../web/charts';

        $today = new \DateTime();

        $today = $today->format('d-m-Y');

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $suspended = $em->getRepository('AppBundle:Instance')->getSuspendedInstanceCount();


        $suspended = ['c' => [['v' => $today, 'f' => null], ['v' => $suspended , 'f' => null]]];

        $inp = file_get_contents($filePath.'/suspendedInstance.json');
        $tempArray = json_decode($inp, true);
        $count =  count($tempArray['rows']);

        if ($count >= 15)
        {
            array_shift($tempArray['rows']);

        }
        $tempArray['rows'][] = $suspended;

        file_put_contents($filePath.'/suspendedInstance.json', json_encode($tempArray));

    }
}