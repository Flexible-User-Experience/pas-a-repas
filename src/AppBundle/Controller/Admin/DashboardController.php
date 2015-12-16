<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Dashboard controller.
 *
 * @Route("/admin")
 */
class DashboardController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @Route("/dashboard", name="admin_dasboard")
     * @Method("GET")
     */
    public function dashboardAction()
    {
        $contacts = $this->getDoctrine()->getRepository('AppBundle:Contact')->findAll();

        $contactMsgsAmount = 0;
        $today = new \DateTime('today');

        foreach ($contacts as $contact) {
            if ($contact->getDate()->format('d-m-Y') == $today->format('d-m-Y')) {
                $contactMsgsAmount = $contactMsgsAmount + 1;
            }
        }

        return $this->render('Admin/dashboard.html.twig', array ('contactMsgsAmount' => $contactMsgsAmount));
    }

}