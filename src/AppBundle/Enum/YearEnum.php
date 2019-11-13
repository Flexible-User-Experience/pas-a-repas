<?php

namespace AppBundle\Enum;

/**
 * YearEnum class.
 *
 * @category Enum
 */
class YearEnum
{
    /**
     * @return array
     */
    public static function getEnumArray()
    {
        $result = array();
        for ($year = 2010; $year <= date('Y') + 1; ++$year) {
            array_push($result, $year);
        }

        return $result;
    }
}
