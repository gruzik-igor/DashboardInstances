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
     * @Route("/users/new", name="add-user")
     */
    public function newUserAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(CreateUserForm::class, $user);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted() && $request->getMethod() === 'POST') {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $response = $this->redirect($this->generateUrl('users'));
        }
        else {
            $response = $this->render('@App/user/add.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        return $response;
    }

    /**
     * @Route("/users/edit/{user}", name="edit-user")
     */

    public function editUserAction(User $user, Request $request)
    {
        if ($request->getMethod() === 'POST') {

            $em = $this->getDoctrine()->getManager();

            $userNew = $request->request->all();


            $repository = $em->getRepository('AppBundle:User');
            $user = $repository->findOneBy(['id' => $userNew['user']['id']]);

            if ($user instanceof User) {
                //var_dump($userPhoto);die;
                $user->setUsername($userNew['user']['username']);
                //$user->setRole($userNew['user']['role']);
                $user->setEmail($userNew['user']['email']);
                $user->setDomainName($userNew['user']['domainName']);
                $user->setContactPhone($userNew['user']['contactPhone']);
                $user->setPrimaryLanguage($userNew['user']['primaryLanguage']);

            }

            $userPhoto = $request->files->all();

            if ($userPhoto['user']['photo'] !== null)
            {
                $user->setPhoto($userPhoto['user']['photo']);
            }

            $em->flush();

            $response = $this->redirect($this->generateUrl('users'));
        } else {
            $response = $this->render('@App/user/edit.html.twig', ['user' => $user]);
        }

        return $response;
    }

    /**
     * @Route("/users/delete/{user}", name="delete-user")
     */

    public function edeleteUserAction($user , Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //$userNew = $request->request->all();
        $repository = $em->getRepository('AppBundle:User');
        $user = $repository->find($user);

        if(!$user) {
            return $this->redirect($this->generateUrl('users'));
        }

        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateUrl('users'));
    }

}