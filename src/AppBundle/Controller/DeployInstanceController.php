<?php

namespace AppBundle\Controller;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Instance;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DeployInstanceController extends BaseController
{
    /**
     * @Route("/deploy-instance/{instance}", name="deploy-instance")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function deployInstanceAction(Instance $instance)
    {
        $instanceName = $instance->getName() . '_' . $instance->getId();
        $dbname = 'sf_' . strtolower($instance->getName());
        $new_user = strtolower($instance->getName()) . '_admin';
        $host = '%';
        $new_db_pw = strtolower($instance->getName()) . $instance->getId() . 'QxY37f';
        $path = $this->getParameter('kernel.root_dir') . '/config/parameters.yml';

        //var_dump($path);die;
        $output = shell_exec($this->getParameter('web_dir') . '/deploy/./deploy.sh ' . $instanceName . ' ' . $dbname . ' ' . $new_user . ' ' . $host . ' ' . $new_db_pw  . ' ' . $instance->getId() . ' > /dev/null 2>&1 &');


        $instance->setDeployingStatus('deploying');

        $em = $this->getDoctrine()->getManager();

        $em->persist($instance);
        $em->flush();

        return $this->redirect($this->generateUrl('dashboard').'#instances');
    }


}