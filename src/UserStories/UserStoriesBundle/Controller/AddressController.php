<?php

namespace UserStories\UserStoriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use UserStories\UserStoriesBundle\Entity\Person;
use UserStories\UserStoriesBundle\Entity\Address;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller {

    /**
     * @Route("/{id}/addAddress", name="addAddress_action")
     * @Method({"GET", "POST"})
     */
    public function addAddressAction(Request $request, $id) {
        $repository = $this->getDoctrine()->getRepository('USBundle:Person');
        $person = $repository->find($id);
        $address = new Address();
        $form = $this->createFormBuilder($address)
                ->add('city', 'text', array('label' => 'Miejscowość'))
                ->add('street', 'text', array('label' => 'Ulica'))
                ->add('number', 'text', array('label' => 'Numer domu'))
                ->add('apartmant', 'text', array('label' => 'Numer mieszkania'))
                ->add('save', 'submit', array('label' => 'Zapisz'))
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $address1 = $form->getData();
            $repository2 = $this->getDoctrine()->getRepository('USBundle:Address');
            $addresses = $repository2->findAll();
            foreach ($addresses as $address) {
                if ($address1->getCity() == $address->getCity() &&
                        $address1->getStreet() == $address->getStreet() &&
                        $address1->getNumber() == $address->getNumber() &&
                        $address1->getApartmant() == $address->getApartmant()) {
                    $person->setAddress($address);
                }
            }
            $em = $this->getDoctrine()->getManager();
            if (empty($person->getAddress())) {
                
                
                $em->persist($address);
                $person->setAddress($address);
                $em->persist($person);
                $em->flush();
            } else {
               
                $em->persist($person);
                $em->flush();
            }

            return $this->render('USBundle:Person:show_one.html.twig', array(
                        'person' => $person));
        }
        return $this->render('USBundle:Address:add_address.html.twig', array(
                    'form' => $form->createView(), 'person' => $person));
    }

    /**
     * @Route("/modyfyAddress")
     */
    public function modyfyAddressAction() {
        return $this->render('USBundle:Address:modyfy_address.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/deleteAddress")
     */
    public function deleteAddressAction() {
        return $this->render('USBundle:Address:delete_address.html.twig', array(
                        // ...
        ));
    }

}
