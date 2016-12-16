<?php

namespace UserStories\UserStoriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use UserStories\UserStoriesBundle\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    /**
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {
        return $this->render('USBundle:Person:new.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/{id}/modify")
     * @Method({"GET", "POST"})
     */
    public function modifyAction($id)
    {
        return $this->render('USBundle:Person:modify.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/{id}/delete")
     */
    public function deleteAction($id)
    {
        return $this->render('USBundle:Person:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/")
     */
    public function showAllAction()
    {
        return $this->render('USBundle:Person:show.html.twig', array(
            // ...
        ));
    }
    /**
     * @Route("/{id}")
     */
    public function showOneByIdAction($id) {
        return $this->render('USBundle:Person:show_one.html.twig', array(
            // ...
        ));
    }
    

}
