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
        $this->reportCPU();
        $this->reportRAM();
        $this->reportHDD();
        
    }

    // CPU resourses usage 
    protected function reportCPU()
    {
        $system = new System;
        $os = $system->getOs();

        $filePath = $this->getContainer()->get('kernel')->getRootDir() . '/../web/reports';

        $today = new \DateTime();
        $today = $today->format('H:i:s');

        $cpuPercentage = $os->getLoadPercentage(AbstractOs::TIMEFRAME_1_MIN);
        
        $cpuInfoArray = ['c' => [['v' => $today, 'f' => null], ['v' => $cpuPercentage.' %', 'f' => null]]];

        $inp = file_get_contents($filePath.'/reportCPU.json');
        $tempArray = json_decode($inp, true);
        $tempArray['rows'][] = $cpuInfoArray;
        
        file_put_contents($filePath.'/reportCPU.json', json_encode($tempArray)); 
             
    }

    // RAM resourses usage 
    protected function reportRAM()
    {
        $system = new System;
        $os = $system->getOs();

        $filePath = $this->getContainer()->get('kernel')->getRootDir() . '/../web/reports';

        $today = new \DateTime();
        $today = $today->format('H:i:s');

        $ramUsage = $this->formatBytes($os->getCurrentMemoryUsage());
        
        $ramInfoArray = ['c' => [['v' => $today, 'f' => null], ['v' => $ramUsage.'MB', 'f' => null]]];

        $inp = file_get_contents($filePath.'/reportRAM.json');
        $tempArray = json_decode($inp, true);
        $tempArray['rows'][] = $ramInfoArray;
        
        file_put_contents($filePath.'/reportRAM.json', json_encode($tempArray));        
    }

     // HDD resourses usage 
    protected function reportHDD()
    {
        $system = new System;
        $os = $system->getOs();
        
        $filePath = $this->getContainer()->get('kernel')->getRootDir() . '/../web/reports';

        $today = new \DateTime();
        $today = $today->format('H:i:s');

        $HDD = shell_exec('df -h');

        $tempHDD = explode(" ", $HDD);
        $tempHDD = array_filter($tempHDD);

        //var_dump($tempHDD);die;
        //$hddUsage = $this->formatBytes($os->getCurrentMemoryUsage());
        
        $hddInfoArray = ['c' => [['v' => $today, 'f' => null], ['v' => $tempHDD.'GB', 'f' => null]]];

        $inp = file_get_contents($filePath.'/reportHDD.json');
        $tempArray = json_decode($inp, true);
        $tempArray['rows'][] = $hddInfoArray;
        
        file_put_contents($filePath.'/reportHDD.json', json_encode($tempArray));        
    }

    // Convert from bytes
    private function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');   
    
        return round(pow(1024, $base - floor($base)), $precision);
    } 
    
}