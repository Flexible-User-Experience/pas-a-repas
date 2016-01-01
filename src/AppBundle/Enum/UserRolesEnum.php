<?php

namespace AppBundle\Enum;

/**
 * UserRolesEnum class
 *
 * @category Enum
 * @package  AppBundle\Enum
 * @author   David Romaní <david@flux.cat>
 */
class UserRolesEnum
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_CMS = 'ROLE_CMS';
    const ROLE_MANAGER = 'ROLE_MANAGER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SONATA_ADMIN = 'ROLE_SONATA_ADMIN';

    /**
     * @return array
     */
    public static function getEnumArray()
    {
        return array(
            self::ROLE_USER => 'usuari',
            self::ROLE_CMS => 'editor',
            self::ROLE_MANAGER => 'gestor',
            self::ROLE_ADMIN => 'administrador',
            self::ROLE_SONATA_ADMIN => 'super administrador',
        );
    }
}
