<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Ivory\GoogleMapBundle\Entity\Map;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /** @var Marker $marker */
        $marker = new Marker();
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition(40.7061278, 0.5817055555555556, true);
        $marker->setAnimation(Animation::DROP);

        /** @var Map $mapObject */
        $mapObject = $this->get('ivory_google_map.map');
        $mapObject->setStylesheetOption('width', '100%');
        $mapObject->setLanguage('es');
        $mapObject->setCenter(40.7061278, 0.5817055555555556, true);
        $mapObject->setMapOption('zoom', 15);
        //$mapObject->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
        $mapObject->addMarker($marker);

        /** @var ContactType $contactType */
        $contactType = new ContactType();
        $form = $this->createForm($contactType);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            $em = $this->getDoctrine()->getManager();

            $message = \Swift_Message::newInstance()
                ->setSubject('Pas a repàs contact form')
                ->setFrom($form->get('email')->getData())
                ->setTo('david@flux.cat')
                ->setBody('Has rebut un formulari de contacte de: '. $form->get('name')->getData() . " " . $form->get('phone')->getData() . " " . $form->get('message')->getData())
            ;
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('congratulations');
        }

        return $this->render('default/index.html.twig', array(
            'mapView' => $mapObject,
            'contactForm' => $form->createView(),
        ));
    }

    /**
     * @Route("/congratulations", name="congratulations")
     */
    public function congratulationsAction(Request $request)
    {
        return $this->render('default/congratulations.html.twig');
    }
}