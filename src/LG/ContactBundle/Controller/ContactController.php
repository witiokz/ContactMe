<?php

namespace LG\ContactBundle\Controller;

use LG\ContactBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use LG\ContactBundle\Form\ContactType;
use LG\ContactBundle\Entity;

use LG\ContactBundle\Services\ContactService;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContactController extends Controller
{
    /**
     * @Route("/", name="_main")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/contact-us", name="_contact")
     * @Template()
     */
    public function contactAction()
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);
        $request = $this->get('request');
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {

            if ($form->isValid()) {

                $this->get('contact_service_class')->saveContact($contact);

                $message = \Swift_Message::newInstance()
                    ->setSubject($this->get('translator')->trans('MailHead'))
                    ->setFrom($contact->getEmail())
                    ->setTo($this->container->getParameter('contact_email'))
                    ->setBody($this->get('translator')->trans('MailBody'));

                $this->get('mailer')->send($message);

                $message = $this->get('translator')->trans('CreateContactSucccess');
                $this->get('session')->getFlashBag()->set('notice', $message);

                return new RedirectResponse($this->generateUrl('_main'));
            }
        }

        return array('form' => $form->createView());
    }
}
