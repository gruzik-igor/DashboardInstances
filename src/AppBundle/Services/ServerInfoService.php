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
        $meminfo['MemUsed'] = $mem[1];
        $meminfo['MemFree'] = $mem[2];


        return $meminfo;
        
    }
}

?>