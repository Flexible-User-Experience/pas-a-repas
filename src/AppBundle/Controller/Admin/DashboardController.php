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
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();


        $contactMsgsAmount = 0;
        $postAmount = 0;
        $categoryAmount = 0;
        $today = new \DateTime('today');

        foreach ($contacts as $contact)
        {
            if ($contact->getDate()->format('m') == $today->format('m') && $contact->getDate()->format('Y') == $today->format('Y'))
            {
                $contactMsgsAmount = $contactMsgsAmount + 1;
            }
        }

        foreach ($posts as $post)
        {
             if ($post->getCreatedDate()->format('m') == $today->format('m') && $post->getCreatedDate()->format('Y') == $today->format('Y'))
             {
                $postAmount = $postAmount + 1;
             }
        }

        foreach ($categories as $category)
        {
            if ($category->getCreatedDate()->format('m') == $today->format('m') && $category->getCreatedDate()->format('Y') == $today->format('Y'))
            {
                $categoryAmount = $categoryAmount + 1;
            }
        }

        return $this->render('Admin/dashboard.html.twig', array(
                'contactMsgsAmount' => $contactMsgsAmount,
                'postAmount' => $postAmount,
                'categoryAmount' => $categoryAmount));
        }
    }