<?php

namespace AppBundle\Controller;

use AppBundle\Repository\LicenseRepository;
use Cronfig\Sysinfo\AbstractOs;
use Cronfig\Sysinfo\System;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DashboardController extends BaseController
{
    /**
     * @Route("/", name="dashboard")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        /**
         * @var LicenseRepository $repository
         */
//       $repository = $this->getRepository('AppBundle:License');
//       var_dump($repository->getIssuedLicenseCount()); die;
        $system = new System;
        $os = $system->getOs();

        $serverInfoService = $this->get('app.server_info.service');

        return $this->render('@App/dashboard/index.html.twig', [
            'meminfo'=> $serverInfoService->getSystemMemInfo(),
            'diskinfo' => $serverInfoService->getSystemHddInfo(),
            'cpuinfo' => $os->getLoadPercentage(AbstractOs::TIMEFRAME_1_MIN),
            'uptime' => $serverInfoService->getServerUptime(),
            'servinfo' => $serverInfoService->getSystemInfo(),
            'instances' => $this->findBy('AppBundle:Instance', [], []),
            'invoices' => $this->findBy('AppBundle:Invoice', []),
            'licenseRequest' => $this->findBy('AppBundle:LicenseRequest', [])
            ]);
    }


    // test routes
    /**
     * @Route("/user/info")
     */
    public function infoAction()
    {
        $name = 'Ivan Ivanenko';

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
