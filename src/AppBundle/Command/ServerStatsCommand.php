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
        $reportFile = fopen('reports/report.json', 'w');
        $serverStatServices = $this->getContainer()->get('app.server_info.service');
        var_dump($serverStatServices);
        
    }
    
}