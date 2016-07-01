<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\MemberType;
use AppBundle\Form\MemberCreateType;
use AppBundle\Entity\Member;

/**
 * @Route("/member")
 *
 * @see http://symfony.com/doc/current/book/controller.html
 * @see http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
 */
class MemberController extends Controller
{
    /**
     * This method is used to create a member.
     * 
     * @Route("/create", name="app_member_create")
     * @Method({"GET", "POST"})
     * 
     */
    public function createAction(Request $request)
    {
        $member = new Member();

        $form = $this->createForm(MemberCreateType::class, $member);
        $form->handleRequest($request);

        if ($form->isValid()) 
        {
            /**
             * @var Symfony\Component\HttpFoundation\File\UploadedFile $file
             */
            $file = $member->getAvatar();

            $filename = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                $this->container->getParameter('pix_dir'),
                $filename
            );

            $member->setAvatar($filename);
            $password = $this
                ->get('security.password_encoder')
                ->encodePassword($member, $member->getPlainPassword())
            ;
            $member->setPassword($password);


            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();

            $this->addFlash('notice', 'Le membre a bien été créé');

            return $this->redirectToRoute('app_index', [
                'id' => $member->getId(),
            ]);
        }

        return $this->render('member/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/remove", name="app_member_remove")
     * @Method({"GET", "POST"})
     * @ParamConverter("member", class="AppBundle:Member", options={"id" : "id"})
     */
    public function removeAction(Member $member)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($member);
        $em->flush();

        return $this->redirectToRoute('app_index');
    }

    /**
     * @Route("/", name="app_member_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('AppBundle:Member')->getMembersByNameOrder();

        $nbUpdated = $this->get('app.member_manager')->updateCreationDate($list);

        return $this->render('member/list.html.twig', [
            'list' => $list,
            'nb_updated' => $nbUpdated,
        ]);
    }
    /**
     * This method is used to create or update a member.
     * 
     * @Route("/create/{id}", name="app_member_edit")
     * @Method({"GET", "POST"})
     * @ParamConverter("member", class="AppBundle:Member", options={"id" : "id"})
     */
    public function editAction(Request $request, Member $member)
    {
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();

            $this->addFlash('notice', 'Le membre a bien été créé');

            return $this->redirectToRoute('app_index', [
                'id' => $member->getId(),
            ]);
        }

        return $this->render('member/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
