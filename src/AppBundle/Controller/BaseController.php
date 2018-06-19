<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function findBy($entity, $criteria)
    {
        $repository = $this->getRepository($entity);

        return $repository->findBy($criteria);
    }

    public function getRepository($entity)
    {
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository($entity);
    }
}