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
     * @Route("/contact/{id}/{id2}", name="app_contact_display")
     * @Method({"GET", "POST"})
     * @ParamConverter("sender", class="AppBundle:Member", options={"id" : "id"})
     * @ParamConverter("destin", class="AppBundle:Member", options={"id2" : "id"})
     */

    public function createAction(Request $request, Member $sender, Member $destin)
    {
        
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);


        if($form->isValid())
        {
            $message = \Swift_Message::newInstance()
                ->setSubject($contact->getSubject())
                ->setFrom($sender->getEmail())
                ->setTo($destin->getEmail())
                ->setBody($contact->getContent())
        ;

            $this->get('mailer')->send($message);   
            return $this->redirectToRoute('app_index');
        }

        return $this->render('contact/contact.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}