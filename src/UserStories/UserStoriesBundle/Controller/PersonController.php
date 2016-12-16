<?php

namespace UserStories\UserStoriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PersonController extends Controller
{
    /**
     * @Route("/new")
     */
    public function newAction()
    {
        return $this->render('USBundle:Person:new.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/modify")
     */
    public function modifyAction()
    {
        return $this->render('USBundle:Person:modify.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('USBundle:Person:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/")
     */
    public function showAction()
    {
        return $this->render('USBundle:Person:show.html.twig', array(
            // ...
        ));
    }

}
