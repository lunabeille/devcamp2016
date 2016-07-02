<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\NewsType;
use AppBundle\Entity\News;
use AppBundle\Security\Voter\NewsVoter;

/**
 * @Route("/news")
 */
class NewsController extends Controller
{
    /**
     * This method is used to create or update a news.
     *
     * @Route("/edit/{id}", name="app_news_edit", requirements={"id" : "\d+"}, defaults={"id" : NULL})
     * @Method({"GET", "POST"})
     * @ParamConverter("news", class="AppBundle:News", options={"id" : "id"})
     */
    public function editAction(Request $request, News $news = null)
    {
        if($news instanceof News)
        {
            $this->denyAccessUnlessGranted(NewsVoter::NEWS_UPDATE, $news);
        }

        if (null === $news) {
            $news = new News();
        }

        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($news);
                $em->flush();

                $this->addFlash('notice', 'La news a bien été enregistré');
            } catch (\Exception $e) {
                $this->get('logger')->addError('Error: '.$e->getMessage());
                throw $this->createNotFoundException('Houston, we have a problem!');
            }

            return $this->redirectToRoute('app_index', [
                'id' => $news->getId(),
            ]);
        }

        return $this->render('news/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/remove/{id}", name="app_news_remove", requirements={ "id": "\d+" })
     * @Method({"GET", "POST"})
     * @ParamConverter("news", class="AppBundle:News", options={"id" : "id"})
     */
    public function removeAction(News $news)
    {
        if($news instanceof News)
        {
            $this->denyAccessUnlessGranted(NewsVoter::NEWS_DELETE, $news);
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($news);
        $em->flush();

        return $this->redirectToRoute('app_index');
    }


    /**
     * @Route("/view/{id}", name="app_news_view", requirements={ "id": "\d+" })
     * @Method({"GET", "POST"})
     * @ParamConverter("news", class="AppBundle:News", options={"id" : "id"})
     */
    public function viewAction(News $news)
    {
        
    }
}
