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

        $response = $this->redirectToRoute('dashboard');
        }else {
            $response = $this->render('@App/instance/add.html.twig', ['form' => $form->createView()]);
        }

        return $response;
    }


    private static $docker;

    public static function getDocker(): Docker
    {
        if (null === self::$docker) {
            self::$docker = Docker::create();
        }
        return self::$docker;
    }

    private function getManager()
    {
        return self::getDocker();
    }

    /**
     * @Route("/instance/{instance}", name="docker-status")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */

    public function dockerAction()
    {
        $docker = Docker::create();
        $containerConfig = new ContainersCreatePostBody();
        $containerConfig->setHostname( 'boomrev');
        $containerConfig->setImage('busybox:latest');
        $containerConfig->setDomainname( 'boomrev');
        $containerConfig->setCmd(['echo', 'I am running a command']);
        var_dump($containerConfig);die;
        $containerLogsResult = $docker->getContainerManager()->logs('23b0da3fff80', ["stderr"=>true, "stdout"=>true]);
        $containerCreateResult = $docker->containerCreate($containerConfig);
        var_dump($containerCreateResult);die;
        $containerCreateResult = $docker->containerCreate($containerConfig);


        //$docker->containerStart($containerCreateResult->getId());
        //$docker->containerStart('boomrev');
        var_dump($containerCreateResult);die;
//        $containers = $docker->containerList();
//        var_dump($containers);die;
//        foreach ($containers as $container) {
//            var_dump($container->getNames());die;
//        }

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
