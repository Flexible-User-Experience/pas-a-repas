<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;

/**
 * Contact controller.
 *
 * @Route("/contact")
 */
class ContactController extends Controller
{

    /**
     * Lists all Contact entities.
     *
     * @Route("/", name="contact")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Contact')->findAll();

        return $this->render('Contact/index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Contact entity.
     *
     * @Route("/{id}", name="contact_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Contact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        return $this->render('Contact/show.html.twig', array(
            'entity' => $entity,
        ));
    }
}
