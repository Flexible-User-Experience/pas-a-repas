<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * Set up tests
     */
    public function setUp()
    {
        $this->loadFixtures(array(
            'AppBundle\DataFixtures\ORM\Categories',
            'AppBundle\DataFixtures\ORM\Posts',
        ));
    }

    public function testIndex()
    {
        $client = static::makeClient();
        $client->request('GET', '/');
        $this->assertStatusCode(200, $client);
        $client->request('GET', '/blog');
        $this->assertStatusCode(200, $client);
        $client->request('GET', '/blog/categories');
        $this->assertStatusCode(200, $client);
    }
}
