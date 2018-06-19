<?php

namespace AppBundle\Controller;

use Cronfig\Sysinfo\AbstractOs;
use Cronfig\Sysinfo\System;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="dashboard")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        $system = new System;
        $os = $system->getOs();

        $serverInfoService = $this->get('app.server_info.service');

        return $this->render('@App/dashboard/index.html.twig', [
            'meminfo'=> $serverInfoService->getSystemMemInfo(),
            'diskinfo' => $serverInfoService->getSystemHddInfo(),
            'cpuinfo' => $os->getLoadPercentage(AbstractOs::TIMEFRAME_1_MIN),
            'uptime' => $serverInfoService->getServerUptime(),
            'cpuinfo' => $serverInfoService->getSystemInfo()
            ]);
    }

    /**
     * @Route("/user/info")
     */
    public function infoAction()
    {
        $name = 'Ivan Petrov';

        return new Response('<html><body>Whoo: ' . $name . '</body></html>');
    }

    /**
     * @Route("/user/add")
     */

    public function addAction()
    {
        $name = 'Add New User';

        return new Response('<html><body>User: ' . $name . '</body></html>');
    }
}
