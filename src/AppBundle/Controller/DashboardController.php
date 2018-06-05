<?php

namespace AppBundle\Controller;

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
        // replace this example code with whatever you need
        return $this->render('@App/dashboard/index.html.twig');
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
