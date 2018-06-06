<?php

namespace AppBundle\Services;

class ServerInfoService 
{
    public function getSystemMemInfo() 
    {   
        $free = shell_exec('free -m');
        $free = (string)trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $meminfo['MemTotal'] = $mem[1];
        $meminfo['MemUsed'] = $mem[2];


        return $meminfo;
        
    }

    public function getSystemHddInfo() {
	
        $disktotal = disk_total_space ('/');
        $diskfree  = disk_free_space  ('/');
        $diskInfo['DisckTotal'] = $disktotal;
        $diskInfo['DisckUsed'] = $disktotal - $diskfree;

        return $diskInfo;
        
    }

    public function getSystemCpuInfo() {
        
        $stat1 = file('/proc/stat'); 
        sleep(1); 
        $stat2 = file('/proc/stat'); 
        $info1 = explode(" ", preg_replace("!cpu +!", "", $stat1[0])); 
        $info2 = explode(" ", preg_replace("!cpu +!", "", $stat2[0])); 
        $dif = array(); 
        $dif['user'] = $info2[0] - $info1[0]; 
        $dif['nice'] = $info2[1] - $info1[1]; 
        $dif['sys'] = $info2[2] - $info1[2]; 
        $dif['idle'] = $info2[3] - $info1[3]; 
        $total = array_sum($dif); 
        $cpuinfo = array(); 
        foreach($dif as $x=>$y) $cpuinfo[$x] = round($y / $total * 100, 1);

        return $cpuinfo;
    }

    
}

?>