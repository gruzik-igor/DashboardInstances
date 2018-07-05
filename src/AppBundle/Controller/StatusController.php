<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Instance;
use AppBundle\Form\InstanceForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserForm;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class StatusController extends BaseController
{
    /**
     * @Route("/status/{instance}?status={status}", name="change-status")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function statusAction( Instance $status, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Instance');
        var_dump($repository->findBy(["status" => 'active'])); die;
//        $instance = new Instance();
//        $form = $this->createForm(InstanceForm::class,$instance);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid() && $request->getMethod() === 'POST') {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($instance);
//            $em->flush();
//
//            $response = $this->redirectToRoute('dashboard');
//        }else {
//            $response = $this->render('@App/instance/add.html.twig', ['form' => $form->createView()]);
//        }
//
//        return $response;
    }
}
