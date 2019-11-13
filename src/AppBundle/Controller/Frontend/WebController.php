<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Contact;
use AppBundle\Form\Type\ContactType;
use AppBundle\Service\GoogleMapsService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WebController.
 *
 * @category Controller
 *
 * @author   David Romaní <david@flux.cat>
 */
class WebController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepageAction(Request $request)
    {
        $flash = null;
        /** @var GoogleMapsService $gms */
        $gms = $this->get('app.google_maps_service');
        $mapObject = $gms->buildMap(40.7061278, 0.5817055555555556, 15);
        /** @var Contact $contactEntity */
        $contactEntity = new Contact();
        $form = $this->createForm(ContactType::class, $contactEntity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // persist entity
            $em = $this->getDoctrine()->getManager();
            $contactEntity->setDescription('');
            $em->persist($contactEntity);
            $em->flush();
            // send notifications
            $messenger = $this->get('app.notification');
            $messenger->sendUserNotification($contactEntity);
            $messenger->sendAdminNotification($contactEntity);
            // reset form
            $contactEntity = new Contact();
            $form = $this->createForm(ContactType::class, $contactEntity);
            // build flash message
            $flash = 'frontend.index.main.sent';
        }

        return $this->render('Front/Web/homepage.html.twig', array(
            'mapView' => $mapObject,
            'contactForm' => $form->createView(),
            'flash' => $flash,
        ));
    }

    /**
     * @Route("/credits", name="credits")
     */
    public function creditsAction()
    {
        return $this->render('Front/Web/credits.html.twig');
    }

    /**
     * @Route("/politica-de-privacitat", name="privacy_policy")
     */
    public function privacyPolicyAction()
    {
        return $this->render('Front/Web/privacy_policy.html.twig');
    }
}
