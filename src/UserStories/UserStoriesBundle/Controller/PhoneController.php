<?php

namespace UserStories\UserStoriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use UserStories\UserStoriesBundle\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserStories\UserStoriesBundle\Entity\Phone;

class PhoneController extends Controller
{
    /**
     * @Route("/{id}/addPhone", name="addPhone_action")
     * @Method({"GET", "POST"})
     */
    public function addPhoneAction(Request $request, $id)
    {   
        $repository = $this->getDoctrine()->getRepository('USBundle:Person');
        $person = $repository->find($id);
        $phone = new Phone();
        $form = $this->createFormBuilder($phone)
                ->add('number', 'text', array('label' => 'Numer'))
                ->add('type', 'text', array('label' => 'typ'))
                ->add('save', 'submit', array('label' => 'Zapisz'))
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            
            $phone = $form->getData();
            
            $phone->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $person->addPhone($phone);
            $em->persist($person);
            $em->persist($phone);
            $em->flush();

            return $this->render('USBundle:Person:show_one.html.twig', array(
                        'person' => $person));
        }
        return $this->render('USBundle:Phone:add_phone.html.twig', array(
                    'form' => $form->createView(), 'person' => $person));
    }

    

    /**
     * @Route("/{id}/deletePhone", name="deletePhone_action")
     */
    public function deletePhoneAction($id)
    {   
        $repository = $this->getDoctrine()->getRepository('USBundle:Phone');
        $phone = $repository->find($id);
        $person = $phone->getPerson();
         $em = $this->getDoctrine()->getManager();
         $em->remove($phone);
         $em->flush();
        return $this->render('USBundle:Person:show_one.html.twig', array(
                'person' => $person
        ));
    }

}
