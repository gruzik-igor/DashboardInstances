<?php 

namespace AppBundle\Command;

use Cronfig\Sysinfo\AbstractOs;
use Wrep\Daemonizable\Command\EndlessContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Cronfig\Sysinfo\System;

class ServerStatsCommand extends EndlessContainerAwareCommand

{
	// This is just a normal Command::configure() method
	protected function configure()
	{
		$this->setName('app:server:info')
			 ->setDescription('An EndlessCommand implementation example');
	}

	// Execute will be called in a endless loop
	protected function execute(InputInterface $input, OutputInterface $output)
    {
        $system = new System;
        $os = $system->getOs();

        $filePath = $this->getContainer()->get('kernel')->getRootDir() . '/../web/reports';

        $today = new \DateTime();
        $today = $today->format('H:i:s');

        $cpuPercentage = $os->getLoadPercentage(AbstractOs::TIMEFRAME_1_MIN);
        
        $cpuInfoArray = ['c' => [['v' => $today, 'f' => null], ['v' => $cpuPercentage, 'f' => null]]];

        $inp = file_get_contents($filePath.'/report.json');
        $tempArray = json_decode($inp, true);
        $tempArray['rows'][] = $cpuInfoArray;
        
        file_put_contents($filePath.'/report.json', json_encode($tempArray));        
    }
    
}