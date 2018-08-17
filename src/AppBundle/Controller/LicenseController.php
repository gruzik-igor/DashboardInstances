<?php

namespace AppBundle\Controller;

use AppBundle\Entity\License;
use AppBundle\Entity\Resource;
use AppBundle\Form\LicenseForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserForm;
use AppBundle\Entity\User;


class LicenseController extends BaseController
{
    /**
     * @Route("/licenses/{license}", name="edit-license")
     */
    public function editAction(License $license, Request $request)
    {
        $form = $this->createForm(LicenseForm::class, $license);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($license);
            $em->flush();
        }



        return $this->redirect($this->generateUrl('dashboard').'#licenses');
    }

}
