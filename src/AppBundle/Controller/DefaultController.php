<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/index", name="app_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('AppBundle:News')->findAll();

        // $members = $em->getRepository('AppBundle:Member')
        // ->findMembersWhoHaveAlreadyWroteMoreThanNNews(1);

        return $this->render('default/index.html.twig', [
            'list' => $list,
            // 'members' => $members,
         ]);
    }
}
