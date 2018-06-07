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
        $diskInfo['DisckTotal'] = round(((($disktotal/8)/1024)/1024)/1024,2);
        $diskInfo['DisckUsed'] = round((((($disktotal - $diskfree)/8)/1024)/1024)/1024,2);

        return $diskInfo;
        
    }
    
    public  function getSystemCpuInfo($coreCount = 1, $interval = 1) {
            $rs = sys_getloadavg();
            $interval = $interval >= 1 && 3 <= $interval ? $interval : 1;
            $load = $rs[$interval];
            $cpuinfo = ($load * 100) / $coreCount;
            return $cpuinfo;
        }

    public   function getServerUptime() {
        $time = @file_get_contents( "/proc/uptime");

        $time = explode(" ",$time);
        $time = $time[0];
        $days = explode(".",(($time % 31556926) / 86400));
        $hours = explode(".",((($time % 31556926) % 86400) / 3600));
        $minutes = explode(".",(((($time % 31556926) % 86400) % 3600) / 60));
        $seconds = explode(".",((((($time % 31556926) % 86400) % 3600) / 60) / 60));
    
        $uptime = $days[0].":".$hours[0].":".$minutes[0].":".$seconds[0];
    
          
            return $uptime;
            
        }

    
}

?>