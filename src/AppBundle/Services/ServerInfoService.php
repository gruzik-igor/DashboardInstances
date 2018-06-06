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
    public function GetCoreInformation() {
        $data = file('/proc/stat');
        $cores = array();
        foreach( $data as $line ) {
            if( preg_match('/^cpu[0-9]/', $line) )
            {
                $info = explode(' ', $line );
                $cores[] = array(
                    'user' => $info[1],
                    'nice' => $info[2],
                    'sys' => $info[3],
                    'idle' => $info[4]
                );
            }
        }
        return $cores;
    }

    var $stat1 = GetCoreInformation();
    var $stat1 = GetCoreInformation();

    public function getSystemCpuInfo($stat1, $stat2) {
        if( count($stat1) !== count($stat2) ) {
            return;
        }
        $cpuinfo = array();
        for( $i = 0, $l = count($stat1); $i < $l; $i++) {
            $dif = array();
            $dif['user'] = $stat2[$i]['user'] - $stat1[$i]['user'];
            $dif['nice'] = $stat2[$i]['nice'] - $stat1[$i]['nice'];
            $dif['sys'] = $stat2[$i]['sys'] - $stat1[$i]['sys'];
            $dif['idle'] = $stat2[$i]['idle'] - $stat1[$i]['idle'];
            $total = array_sum($dif);
            $cpu = array();
            foreach($dif as $x=>$y) $cpu[$x] = round($y / $total * 100, 1);
            $cpuinfo['cpu' . $i] = $cpu;
        }
        return $cpuinfo;
    }
}

?>