<?php

namespace AppBundle\Services;

class ServerInfoService 
{
    public function getSystemMemInfo() 
    {       
        $data = explode("\n", file_get_contents("/proc/meminfo"));
        $meminfo = array();
        foreach ($data as $line) {
            list($key, $val) = explode(":", $line);
            $meminfo[$key] = trim($val);
        }
        return $meminfo;
    }
}

?>