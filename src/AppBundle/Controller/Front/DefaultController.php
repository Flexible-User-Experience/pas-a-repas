<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Contact;
use AppBundle\Form\Type\ContactType;
use AppBundle\Service\GoogleMapsService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 *
 * @category Controller
 * @package  AppBundle\Controller\Front
 * @author   David Romaní <david@flux.cat>
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Ivory\GoogleMap\Exception\AssetException
     * @throws \Ivory\GoogleMap\Exception\MapException
     * @throws \Ivory\GoogleMap\Exception\OverlayException
     */
    public function indexAction(Request $request)
    {
        /** @var GoogleMapsService $gms */
        $gms = $this->get('app.google_maps_service');
        $mapObject = $gms->buildMap(40.7061278, 0.5817055555555556, 'ca', 15);
        /** @var ContactType $contactType */
        $contactType = new ContactType();
        /** @var Contact $contactEntity */
        $contactEntity = new Contact();

        $form = $this->createForm($contactType, $contactEntity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // send notification email
            $mailer = $this->get('app.mailer');
            $mailer->sendEmail(
                $contactEntity->getEmail(),
                $this->container->getParameter('mailer_destination'),
                'Pas a repàs contact form',
                $this->renderView('Front/Web/email.html.twig', array('contactEntity' => $contactEntity))
            );
            // persist new contact message record
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactEntity);
            $em->flush();
            // add view flash message
            $this->addFlash('notice','frontend.index.main.sent');
        }

        return $this->render('Front/Web/homepage.html.twig', array(
            'mapView' => $mapObject,
            'contactForm' => $form->createView(),
        ));
    }
}
