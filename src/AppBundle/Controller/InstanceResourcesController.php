<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Instance;
use AppBundle\Entity\InstanceResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class InstanceResourcesController extends BaseController
{

    /**
     * @Route("/instance-resources/{instance}", name="instance-resources")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function instanceResourcesAction(Instance $instance, Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $em = $this->getDoctrine()->getManager();

            $resources = $request->get('resources');
            $repository = $em->getRepository('AppBundle:InstanceResource');

            foreach ($resources as $resource) {
                $instanceResource = $repository->findOneById($resource['id']);

                if ($instanceResource instanceof InstanceResource) {
                    $instanceResource->setValue($resource['value']);

                }
            }

            $em->flush();

            $response = $this->redirect($this->generateUrl('dashboard') . '#instances');
        } else {
            $response = $this->render('@App/instance/instanceResources.html.twig', ['instance' => $instance]);
        }

        return $response;
    }


}
