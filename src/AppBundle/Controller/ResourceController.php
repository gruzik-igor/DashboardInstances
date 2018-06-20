<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Resource;
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
        $response = $this->render('@App/resources/index.html.twig',
            [
                'resources' => $this->findBy('AppBundle:Resource', [])
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

            $response = $this->redirectToRoute('dashboard');
        }

        return $response;
    }
}
