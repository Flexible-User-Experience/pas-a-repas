<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;

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

        return $this->render('Admin/dashboard.html.twig');
    }

}