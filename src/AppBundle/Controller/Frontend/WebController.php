<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Contact;
use AppBundle\Form\Type\ContactType;
use AppBundle\Service\GoogleMapsService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WebController
 *
 * @category Controller
 * @package  AppBundle\Controller\Frontend
 * @author   David Romaní <david@flux.cat>
 */
class WebController extends Controller
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
    public function homepageAction(Request $request)
    {
        /** @var GoogleMapsService $gms */
        $gms = $this->get('app.google_maps_service');
        $mapObject = $gms->buildMap(40.7061278, 0.5817055555555556, $this->container->getParameter('locale'), 15);
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
            $this->addFlash('notice', 'frontend.index.main.sent');
        }

        return $this->render('Front/Web/homepage.html.twig', array(
            'mapView' => $mapObject,
            'contactForm' => $form->createView(),
        ));
    }
}
