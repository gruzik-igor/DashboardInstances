<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Instance;
use AppBundle\Form\InstanceForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Docker\Stream\DockerRawStream;
use Docker\API\Model\ContainerConfig;
use Docker\API\Model\ContainersCreatePostBody;
use Docker\DockerClientFactory;
use Docker\Context\ContextBuilder;
use Docker\Docker;

class InstanceController extends BaseController
{
    /**
     * @Route("/instance/new", name="add-instance")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
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

            $response = $this->redirect($this->generateUrl('dashboard') . '#instances');
        }else {
            $response = $this->render('@App/instance/add.html.twig', ['form' => $form->createView()]);
        }

        return $response;
    }

    /**
     * @Route("/license/edit/{instance}", name="edit-instance-license")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function instanceLicenseAction(Instance $instance, Request $request)
    {
        if ($request->getMethod() === 'POST') {

            $em = $this->getDoctrine()->getManager();

            $instNew = $request->request->all();

            $repository = $em->getRepository('AppBundle:Instance');
            $instance = $repository->findOneBy(['id' => $instNew['instance']['id']]);

            if ($instance instanceof Instance) {
                $instance->setLicenseIssued($instNew['instance']['licenseIssued']);
                $instance->setLicenseRate($instNew['instance']['licenseRate']);
            }

            $em->flush();

            $response = $this->redirect($this->generateUrl('dashboard') . '#licenses');
        } else {
            $response = $this->render('@App/instance/instanceLicense.html.twig', ['instance' => $instance]);
        }

        return $response;
    }

    /**
     * @Route("/instance/{instance}", name="change-status")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function statusAction(Instance $instance, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $instance->setStatus($request->query->get('status'));
        $em->persist($instance);
        $em->flush();

        return $this->redirect($this->generateUrl('dashboard').'#instances');
    }
}
