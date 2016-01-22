<?php

namespace AppBundle\Enum;

/**
 * ReceiptTypeEnum class
 *
 * @category Enum
 * @package  AppBundle\Enum
 * @author   Anton Serra <aserratorta@gmial.com>
 */
class ReceiptTypeEnum
{
    const HOUR_SINGLE = 'HOUR_SINGLE';
    const HOUR_GROUP = 'HOUR_GROUP';

    /**
     * @return array
     */
    public static function getEnumArray()
    {
        // TODO check database old version values
        return array(
            self::HOUR_SINGLE => 'classe particular',
            self::HOUR_GROUP => 'classe en grup',
        );
    }
}
