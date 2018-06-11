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

        $reportFile = fopen($filePath.'/report.json', 'wr');
        
        $serverStatServices = $this->getContainer()->get('app.server_info.service');
        $today = new \DateTime();
        $today = $today->format('m-d H:i:s');
        $cpuReport = fread($reportFile, filesize($filePath));
        if ($cpuReport) {
            $cpuInfoArray = array_merge(json_decode($cpuReport, true), [$today, $serverStatServices->getSystemCpuInfo()]);
        }
        else {
            $cpuInfoArray = [$today, $serverStatServices->getSystemCpuInfo()];
        }
        
        fwrite($reportFile, json_encode($cpuInfoArray));
        fclose($reportFile);
    }
    
}