<?php

namespace AppBundle\Service;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlay\Animation;
use Ivory\GoogleMap\Overlay\Marker;
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
     * @var string
     */
    private $locale;

    /**
     * GoogleMapsService constructor
     *
     * @param string $locale
     */
    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Build a Google Map
     *
     * @param float $latitude
     * @param float $longitude
     * @param int   $zoom
     *
     * @return Map
     */
    public function buildMap($latitude, $longitude, $zoom = 15)
    {
        $position = new Coordinate($latitude, $longitude);
        /** @var Marker $marker */
        $marker = new Marker($position);
        $marker->setAnimation(Animation::DROP);
        /** @var Map $map */
        $map = new Map();
        $map->setStylesheetOption('width', '100%');
        $map->setStylesheetOption('height', '100%');
        $map->setCenter($position);
        $map->setMapOption('zoom', $zoom);
        $map->getOverlayManager()->addMarker($marker);

        return $map;
    }
}
