<?php

namespace UserStories\UserStoriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use UserStories\UserStoriesBundle\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller {

    /**
     * @Route("/new", name="new_action")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $person = new Person();
        $form = $this->createFormBuilder($person)
                ->add('name', 'text', array('label' => 'Imię'))
                ->add('surname', 'text', array('label' => 'Nazwisko'))
                ->add('description', 'text', array('label' => 'Opis'))
                ->add('save', 'submit', array('label' => 'Potwierdź'))
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $person = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($person);

            $em->flush();
            return $this->render('USBundle:Person:show_one.html.twig', array(
                        'person' => $person));
        }
        return $this->render('USBundle:Person:new.html.twig', array(
                    'form' => $form->createView()));
    }

    /**
     * @Route("/{id}/modify", name="modyfy_action")
     * @Method({"GET", "POST"})
     */
    public function modifyAction($id) {
        return $this->render('USBundle:Person:modify.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/{id}/delete", name="delete_action")
     */
    public function deleteAction($id) {
        $repository = $this->getDoctrine()->getRepository('USBundle:Person');
        $person = $repository->find($id);

        if ($person) {
        
            $em = $this->getDoctrine()->getManager(); 
            $em->remove($person);
            $em->flush();
            return $this->render('USBundle:Person:delete.html.twig', array(
                        'tekst' => 'usunięto kontakt'
        ));
        } else {
            return $this->render('USBundle:Person:delete.html.twig', array(
                        'tekst' => 'nie ma takiego kontaktu'));
        }


        
    }

    /**
     * @Route("/main", name="main_page")
     */
    public function showAllAction() {

        $repository = $this->getDoctrine()->getRepository('USBundle:Person');
        $persons = $repository->findAll();

        return $this->render('USBundle:Person:showAll.html.twig', array('persons' => $persons)
        );
    }

    /**
     * @Route("/{id}")
     */
    public function showOneByIdAction($id) {

        $repository = $this->getDoctrine()->getRepository('USBundle:Person');
        $person = $repository->find($id);

        return $this->render('USBundle:Person:show_one.html.twig', array(
                    'person' => $person
        ));
    }

}
