<?php

namespace AppBundle\Service;

use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Map;

/**
 * Class GoogleMapsService
 *
 * @category Service
 * @package  AppBundle\Service
 * @author   David Romaní <david@flux.cat>
 */
class GoogleMapsService
{
    /**
     * GoogleMapsService constructor
     */
    public function __construct()
    {
    }

    /**
     * Build a Google Map
     *
     * @param float  $latitude
     * @param float  $longitude
     * @param string $language
     * @param int    $zoom
     *
     * @return Map
     * @throws \Ivory\GoogleMap\Exception\AssetException
     * @throws \Ivory\GoogleMap\Exception\MapException
     * @throws \Ivory\GoogleMap\Exception\OverlayException
     */
    public function buildMap($latitude, $longitude, $language = 'es', $zoom = 15)
    {
        /** @var Marker $marker */
        $marker = new Marker();
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition($latitude, $longitude, true);
        $marker->setAnimation(Animation::DROP);
        /** @var Map $map */
        $map = new Map();
        $map->setStylesheetOption('width', '100%');
        $map->setStylesheetOption('height', '100%');
        $map->setLanguage($language);
        $map->setCenter($latitude, $longitude, true);
        $map->setMapOption('zoom', $zoom);
//        $map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
        $map->addMarker($marker);

        return $map;
    }
}
