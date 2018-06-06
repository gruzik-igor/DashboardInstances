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
        $diskInfo['DisckTotal'] = ($disktotal / 8) / 2048;
        $diskInfo['DisckUsed'] = (($disktotal - $diskfree)/8)/2048;

        return $diskInfo;
        
    }

    function getSystemCpuInfo($coreCount = 1, $interval = 1) {
        $rs = sys_getloadavg();
        $interval = $interval >= 1 && 3 <= $interval ? $interval : 1;
        $load = $rs[$interval];
        $cpuinfo = $load ;
       // $cpuinfo = round(($load * 100) / $coreCount,2);
        return $cpuinfo;
    }
}

?>