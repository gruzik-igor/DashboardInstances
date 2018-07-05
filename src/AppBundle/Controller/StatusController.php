<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Instance;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class StatusController extends BaseController
{
    /**
     * @Route("/status", name="change-status")  //{id}?status={status}
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function statusAction(Request $request)
    {
        $instance = new Instance();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Instance');
        $instance->setStatus('acvive');
        $em->persist($instance);
        $em->flush();
        return new Response('good');
        //var_dump($repository->findBy(["status" => 'active'])); die;
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
