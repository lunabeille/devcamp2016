<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Member;
use AppBundle\Form\ContactType;
use AppBundle\Entity\Contact;

/**
 * @Route("/member")
 */
 
class ContactMemberController extends Controller
{


    /**
     * This method is used to display the contact form.
     * 
     * @Route("/contact/{id}", name="app_contact_display")
     * @Method({"GET", "POST"})
     * 
     */

    public function createAction(Request $request, Member $member)
    {
        $form = $this->createForm(ContactType::class, new Contact());
        $form->handleRequest($request);

        if($form->isValid())
        {
            $this->get('mailer')->send($message);   
            $this->redirectRoute('app_index');
        }

        return $this->render('contact/contact.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}