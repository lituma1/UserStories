<?php

namespace UserStories\UserStoriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use UserStories\UserStoriesBundle\Entity\Person;
use UserStories\UserStoriesBundle\Entity\Email;

class EmailController extends Controller
{
    /**
     * @Route("/{id}/addEmail", name="addEmail_action")
     * @Method({"GET", "POST"})
     */
    public function addEmailAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('USBundle:Person');
        $person = $repository->find($id);
        $email = new Email();
        $form = $this->createFormBuilder($email)
                ->add('mail', 'text', array('label' => 'Adres mailowy'))
                ->add('type', 'text', array('label' => 'typ'))
                ->add('save', 'submit', array('label' => 'Zapisz'))
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            
            $email = $form->getData();
            
            $email->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $person->addEmail($email);
            $em->persist($person);
            $em->persist($email);
            $em->flush();

            return $this->render('USBundle:Person:show_one.html.twig', array(
                        'person' => $person));
        }
        return $this->render('USBundle:Email:add_email.html.twig', array(
                    'form' => $form->createView(), 'person' => $person));
    }

    /**
     * @Route("/{id}/deleteEmail", name="deleteEmail_action")
     */
    public function deleteEmailAction($id)
    {
       $repository = $this->getDoctrine()->getRepository('USBundle:Email');
        $email = $repository->find($id);
        $person = $email->getPerson();
         $em = $this->getDoctrine()->getManager();
         $em->remove($email);
         $em->flush();
        return $this->render('USBundle:Person:show_one.html.twig', array(
                'person' => $person
        ));
    }

}
