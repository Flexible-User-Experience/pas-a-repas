<?php

namespace AppBundle\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class BaseTest
 *
 * @category Test
 * @package  AppBundle\Tests
 * @author   David Romaní <david@flux.cat>
 */
abstract class BaseTest extends WebTestCase
{
    /**
     * Set up test
     */
    public function setUp()
    {
        $this->runCommand('hautelook_alice:doctrine:fixtures:load');
    }
}
