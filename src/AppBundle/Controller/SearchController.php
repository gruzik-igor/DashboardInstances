<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Instance;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends BaseController
{
    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request){

        $data = $request->get('query');

        $repository = $this->getDoctrine()->getRepository('AppBundle:Instance');
        $invoices = $this->getDoctrine()->getRepository('AppBundle:Invoice');
        return $this->render('@App/search/search.html.twig', array( 'instances' => $repository->search($data),'invoices' => $invoices->findAll() ));
    }


}
