<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Instance;
use AppBundle\Entity\Resource;
use AppBundle\Form\InstanceForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserForm;
use AppBundle\Entity\User;


class InstanceController extends BaseController
{
    /**
     * @Route("/instance/new", name="add-instance")
     */
    public function addAction( Request $request)
    {
        $instance = new Instance();
        $form = $this->createForm(InstanceForm::class,$instance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->getMethod() === 'POST') {
            $em = $this->getDoctrine()->getManager();
            $em->persist($instance);
            $em->flush();
        }



        return $this->render('@App/instance/add.html.twig', ['form' => $form->createView()]);
    }
}
