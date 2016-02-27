<?php

namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CreditsController
 *
 * @category Controller
 * @package  AppBundle\Controller\Frontend
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class CreditsController extends Controller
{
    /**
     * @Route("/credits", name="credits")
     */
    public function creditsAction()
    {
        return $this->render('Front/Web/credits.html.twig');
    }
}
