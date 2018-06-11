<?php 

namespace AppBundle\Command;

use Wrep\Daemonizable\Command\EndlessContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

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
        $filePath = $this->getContainer()->get('kernel')->getRootDir() . '/../web/reports';

        
        $serverStatServices = $this->getContainer()->get('app.server_info.service');

        $today = new \DateTime();
        $today = $today->format('m-d H:i:s');

        $cpuPercentage = intval(100 - $serverStatServices->getSystemCpuInfo()['sysstat']['hosts'][0]['statistics'][0]['cpu-load'][0]['idle']);
        
        $cpuInfoArray = [[$today, $cpuPercentage]];

        $inp = file_get_contents($filePath.'/report.json');
        $tempArray = json_decode($inp, true);
        if ($tempArray) {
            array_push($tempArray, $cpuInfoArray);
        }
        file_put_contents($filePath.'/report.json', json_encode($cpuInfoArray), FILE_APPEND);        
    }
    
}