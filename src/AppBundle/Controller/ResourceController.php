<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Resource;
use AppBundle\Form\ResourceForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserForm;
use AppBundle\Entity\User;


class ResourceController extends BaseController
{
    /**
     * @Route("/resources", name="resources")
     */
    public function resourcesAction(Request $request)
    {
        $resources = $this->findBy('AppBundle:Resource', []);

        if ($resources){
            $response = $this->render('@App/resources/index.html.twig',
                [
                    'resources' => $resources
                ]);

            if ($request->getMethod() === 'POST') {
                $em = $this->getDoctrine()->getManager();

                $repository = $this->getRepository('AppBundle:Resource');

                $resources = $request->request->get('resources');

                foreach ($resources as $item) {
                    $resource = $repository->findOneBy(['name' => $item['resourceName']]);

                    if ($resource instanceof Resource) {
                        $resource->setDefaultValue($item['defaultValue']);

                        $em->persist($resource);
                    }
                }

                $em->flush();

                $response = $this->redirect($this->generateUrl('dashboard') . '#instances');
            }
        }
         else {
            $response = $this->redirectToRoute('add-resources');
         }

        return $response;
    }

    /**
     * @Route("/resources/new", name="add-resources")
     */
    public function addAction( Request $request)
    {
        $resources = $this->findBy('AppBundle:Resource', []);
        $resource = new Resource();
        $form = $this->createForm(ResourceForm::class,$resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->getMethod() === 'POST') {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resource);
            $em->flush();

            $response = $this->redirect($this->generateUrl('dashboard') . '#instances');
        }else {
            $response = $this->render('@App/resources/index.html.twig', ['form' => $form->createView(),'resources'=> $resources]);
        }

        return $response;
    }
}
