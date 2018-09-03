<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\CreateUserForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserForm;
use AppBundle\Entity\User;


class CreateUserController extends BaseController
{


    /**
     * @Route("/user/new", name="new-user")
     */
    public function newUser(Request $request)
    {
        $user = new User();

        $form = $this->createForm(CreateUserForm::class, $user);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted() && $request->getMethod() === 'POST') {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $response = $this->redirect($this->generateUrl('dashboard') . '#instances');
        }
        else {
            $response = $this->render('@App/user/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        return $response;
    }

}