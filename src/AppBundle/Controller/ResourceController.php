<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserForm;
use AppBundle\Entity\User;


class ResourceController extends Controller
{
    /**
     * @Route("/resources", name="resources")
     */
    public function resourcesAction(Request $request)
    {
        return $this->render('@App/resources/index.html.twig');
    }
}
