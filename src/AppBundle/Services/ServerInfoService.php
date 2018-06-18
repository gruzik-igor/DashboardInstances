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
        $diskInfo['DisckTotal'] = round((($disktotal/1024)/1024)/1024,2);
        $diskUsage = $disktotal - $diskfree;
        $diskInfo['DisckUsed'] = round((($diskUsage/1024)/1024)/1024,2);

        return $diskInfo;
        
    }
    
    public  function getSystemCpuInfo() {
        $cpuInfo = json_decode(shell_exec('mpstat -o JSON'), true);

        return $cpuInfo;
        }

    public   function getServerUptime() {
        $time = @file_get_contents( "/proc/uptime");

        $time = explode(" ",$time);
        $time = $time[0];
        $days = explode(".",(($time % 31556926) / 86400));
        $hours = explode(".",((($time % 31556926) % 86400) / 3600));
        $minutes = explode(".",(((($time % 31556926) % 86400) % 3600) / 60));
        $seconds = explode(".",((((($time % 31556926) % 86400) % 3600) / 60) / 60));
    
        $uptime = $days[0]." days, ".$hours[0]." hours, ".$minutes[0]." minutes ";
    
          
        return $uptime;
            
    }

    public function getSystemInfo() 
    {   
        $free = shell_exec('cat /proc/cpuinfo');
        
        $sysinfo = explode("\n", $free);

        var_dump($sysinfo);

        $new_array = array();
        
        array_walk($sysinfo, replace_arr() , $new_array);    
        
        
       
    } 

    

    public function replace_arr ($val, $key){
        $nums = explode(': ',$val);
       return $new_array[$nums[0]] = $nums[1];
        
        //var_dump($new_array);die;
        
        // if (array_key_exists(1, $nums)) {
        //     $new_array[$nums[0]] = $nums[1];
        // } 
        var_dump($new_array);die;
    }

    
}

?>