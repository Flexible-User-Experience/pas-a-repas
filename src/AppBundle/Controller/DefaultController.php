<?php

namespace AppBundle\Controller;

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


        return $this->render('default/index.html.twig', array(
            'mapView' => $mapObject,
        ));
    }
}
