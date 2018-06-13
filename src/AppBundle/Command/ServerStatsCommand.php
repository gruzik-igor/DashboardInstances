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
        
        $cpuInfoArray = ['c' => [['v' => $today, 'f' => null], ['v' => $cpuPercentage, 'f' => null]]];

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
        
        $ramInfoArray = ['c' => [['v' => $today, 'f' => null], ['v' => $ramUsage, 'f' => null]]];

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

        $dir = '/';
        // get disk space free (in bytes)
        $disk_free = disk_free_space($dir);

        // get disk space total (in bytes)
        $disk_total = disk_total_space($dir);

        // calculate the disk space used (in bytes)
        $disk_used = $disk_total - $disk_free;

        // percentage of disk used
        //$disk_used_p = sprintf('%.2f',($disk_used / $disk_total) * 100);
        
        // $disk_free = $this->formatBytes($disk_free);
        // $disk_used = $this->convertSize($disk_used);
        // $disk_total = $this->formatBytes($disk_total);

        $hddUsage = $this->formatBytes($disk_used);
   
        $hddInfoArray = ['c' => [['v' => $today, 'f' => null], ['v' => $hddUsage, 'f' => null]]];

        $inp = file_get_contents($filePath.'/reportHDD.json');
        $tempArray = json_decode($inp, true);
        $tempArray['rows'][] = $hddInfoArray;
        
        file_put_contents($filePath.'/reportHDD.json', json_encode($tempArray));        
    }

    // Convert from bytes
    private function formatBytes($size, $precision = 2 )
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB' );
                       
        return round(pow(1024, $base - floor($base)), $precision);
    } 
    
}